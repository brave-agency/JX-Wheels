<?php

/**
 * PKCS#8 Formatted EC Key Handler
 *
 * PHP version 5
 *
 * Processes keys with the following headers:
 *
 * -----BEGIN ENCRYPTED PRIVATE KEY-----
 * -----BEGIN PRIVATE KEY-----
 * -----BEGIN PUBLIC KEY-----
 *
 * Analogous to ssh-keygen's pkcs8 format (as specified by -m). Although PKCS8
 * is specific to private keys it's basically creating a DER-encoded wrapper
 * for keys. This just extends that same concept to public keys (much like ssh-keygen)
 *
 * @author    Jim Wigginton <terrafrost@php.net>
 * @copyright 2015 Jim Wigginton
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      http://phpseclib.sourceforge.net
 */
namespace WPMailSMTP\Vendor\phpseclib3\Crypt\EC\Formats\Keys;

use WPMailSMTP\Vendor\phpseclib3\Common\Functions\Strings;
use WPMailSMTP\Vendor\phpseclib3\Crypt\Common\Formats\Keys\PKCS8 as Progenitor;
use WPMailSMTP\Vendor\phpseclib3\Crypt\EC\BaseCurves\Base as BaseCurve;
use WPMailSMTP\Vendor\phpseclib3\Crypt\EC\BaseCurves\Montgomery as MontgomeryCurve;
use WPMailSMTP\Vendor\phpseclib3\Crypt\EC\BaseCurves\TwistedEdwards as TwistedEdwardsCurve;
use WPMailSMTP\Vendor\phpseclib3\Crypt\EC\Curves\Ed25519;
use WPMailSMTP\Vendor\phpseclib3\Crypt\EC\Curves\Ed448;
use WPMailSMTP\Vendor\phpseclib3\Exception\UnsupportedCurveException;
use WPMailSMTP\Vendor\phpseclib3\File\ASN1;
use WPMailSMTP\Vendor\phpseclib3\File\ASN1\Maps;
use WPMailSMTP\Vendor\phpseclib3\Math\BigInteger;
/**
 * PKCS#8 Formatted EC Key Handler
 *
 * @author  Jim Wigginton <terrafrost@php.net>
 */
abstract class PKCS8 extends \WPMailSMTP\Vendor\phpseclib3\Crypt\Common\Formats\Keys\PKCS8
{
    use Common;
    /**
     * OID Name
     *
     * @var array
     */
    const OID_NAME = ['id-ecPublicKey', 'id-Ed25519', 'id-Ed448'];
    /**
     * OID Value
     *
     * @var string
     */
    const OID_VALUE = ['1.2.840.10045.2.1', '1.3.101.112', '1.3.101.113'];
    /**
     * Break a public or private key down into its constituent components
     *
     * @param string $key
     * @param string $password optional
     * @return array
     */
    public static function load($key, $password = '')
    {
        // initialize_static_variables() is defined in both the trait and the parent class
        // when it's defined in two places it's the traits one that's called
        // the parent one is needed, as well, but the parent one is called by other methods
        // in the parent class as needed and in the context of the parent it's the parent
        // one that's called
        self::initialize_static_variables();
        if (!\WPMailSMTP\Vendor\phpseclib3\Common\Functions\Strings::is_stringable($key)) {
            throw new \UnexpectedValueException('Key should be a string - not a ' . \gettype($key));
        }
        $isPublic = \strpos($key, 'PUBLIC') !== \false;
        $key = parent::load($key, $password);
        $type = isset($key['privateKey']) ? 'privateKey' : 'publicKey';
        switch (\true) {
            case !$isPublic && $type == 'publicKey':
                throw new \UnexpectedValueException('Human readable string claims non-public key but DER encoded string claims public key');
            case $isPublic && $type == 'privateKey':
                throw new \UnexpectedValueException('Human readable string claims public key but DER encoded string claims private key');
        }
        switch ($key[$type . 'Algorithm']['algorithm']) {
            case 'id-Ed25519':
            case 'id-Ed448':
                return self::loadEdDSA($key);
        }
        $decoded = \WPMailSMTP\Vendor\phpseclib3\File\ASN1::decodeBER($key[$type . 'Algorithm']['parameters']->element);
        if (!$decoded) {
            throw new \RuntimeException('Unable to decode BER');
        }
        $params = \WPMailSMTP\Vendor\phpseclib3\File\ASN1::asn1map($decoded[0], \WPMailSMTP\Vendor\phpseclib3\File\ASN1\Maps\ECParameters::MAP);
        if (!$params) {
            throw new \RuntimeException('WPMailSMTP\\Vendor\\Unable to decode the parameters using Maps\\ECParameters');
        }
        $components = [];
        $components['curve'] = self::loadCurveByParam($params);
        if ($isPublic) {
            $components['QA'] = self::extractPoint("\0" . $key['publicKey'], $components['curve']);
            return $components;
        }
        $decoded = \WPMailSMTP\Vendor\phpseclib3\File\ASN1::decodeBER($key['privateKey']);
        if (!$decoded) {
            throw new \RuntimeException('Unable to decode BER');
        }
        $key = \WPMailSMTP\Vendor\phpseclib3\File\ASN1::asn1map($decoded[0], \WPMailSMTP\Vendor\phpseclib3\File\ASN1\Maps\ECPrivateKey::MAP);
        if (isset($key['parameters']) && $params != $key['parameters']) {
            throw new \RuntimeException('The PKCS8 parameter field does not match the private key parameter field');
        }
        $components['dA'] = new \WPMailSMTP\Vendor\phpseclib3\Math\BigInteger($key['privateKey'], 256);
        $components['curve']->rangeCheck($components['dA']);
        $components['QA'] = isset($key['publicKey']) ? self::extractPoint($key['publicKey'], $components['curve']) : $components['curve']->multiplyPoint($components['curve']->getBasePoint(), $components['dA']);
        return $components;
    }
    /**
     * Break a public or private EdDSA key down into its constituent components
     *
     * @return array
     */
    private static function loadEdDSA(array $key)
    {
        $components = [];
        if (isset($key['privateKey'])) {
            $components['curve'] = $key['privateKeyAlgorithm']['algorithm'] == 'id-Ed25519' ? new \WPMailSMTP\Vendor\phpseclib3\Crypt\EC\Curves\Ed25519() : new \WPMailSMTP\Vendor\phpseclib3\Crypt\EC\Curves\Ed448();
            // 0x04 == octet string
            // 0x20 == length (32 bytes)
            if (\substr($key['privateKey'], 0, 2) != "\4 ") {
                throw new \RuntimeException('The first two bytes of the private key field should be 0x0420');
            }
            $arr = $components['curve']->extractSecret(\substr($key['privateKey'], 2));
            $components['dA'] = $arr['dA'];
            $components['secret'] = $arr['secret'];
        }
        if (isset($key['publicKey'])) {
            if (!isset($components['curve'])) {
                $components['curve'] = $key['publicKeyAlgorithm']['algorithm'] == 'id-Ed25519' ? new \WPMailSMTP\Vendor\phpseclib3\Crypt\EC\Curves\Ed25519() : new \WPMailSMTP\Vendor\phpseclib3\Crypt\EC\Curves\Ed448();
            }
            $components['QA'] = self::extractPoint($key['publicKey'], $components['curve']);
        }
        if (isset($key['privateKey']) && !isset($components['QA'])) {
            $components['QA'] = $components['curve']->multiplyPoint($components['curve']->getBasePoint(), $components['dA']);
        }
        return $components;
    }
    /**
     * Convert an EC public key to the appropriate format
     *
     * @param \phpseclib3\Crypt\EC\BaseCurves\Base $curve
     * @param \phpseclib3\Math\Common\FiniteField\Integer[] $publicKey
     * @param array $options optional
     * @return string
     */
    public static function savePublicKey(\WPMailSMTP\Vendor\phpseclib3\Crypt\EC\BaseCurves\Base $curve, array $publicKey, array $options = [])
    {
        self::initialize_static_variables();
        if ($curve instanceof \WPMailSMTP\Vendor\phpseclib3\Crypt\EC\BaseCurves\Montgomery) {
            throw new \WPMailSMTP\Vendor\phpseclib3\Exception\UnsupportedCurveException('Montgomery Curves are not supported');
        }
        if ($curve instanceof \WPMailSMTP\Vendor\phpseclib3\Crypt\EC\BaseCurves\TwistedEdwards) {
            return self::wrapPublicKey($curve->encodePoint($publicKey), null, $curve instanceof \WPMailSMTP\Vendor\phpseclib3\Crypt\EC\Curves\Ed25519 ? 'id-Ed25519' : 'id-Ed448');
        }
        $params = new \WPMailSMTP\Vendor\phpseclib3\File\ASN1\Element(self::encodeParameters($curve, \false, $options));
        $key = "\4" . $publicKey[0]->toBytes() . $publicKey[1]->toBytes();
        return self::wrapPublicKey($key, $params, 'id-ecPublicKey');
    }
    /**
     * Convert a private key to the appropriate format.
     *
     * @param \phpseclib3\Math\BigInteger $privateKey
     * @param \phpseclib3\Crypt\EC\BaseCurves\Base $curve
     * @param \phpseclib3\Math\Common\FiniteField\Integer[] $publicKey
     * @param string $secret optional
     * @param string $password optional
     * @param array $options optional
     * @return string
     */
    public static function savePrivateKey(\WPMailSMTP\Vendor\phpseclib3\Math\BigInteger $privateKey, \WPMailSMTP\Vendor\phpseclib3\Crypt\EC\BaseCurves\Base $curve, array $publicKey, $secret = null, $password = '', array $options = [])
    {
        self::initialize_static_variables();
        if ($curve instanceof \WPMailSMTP\Vendor\phpseclib3\Crypt\EC\BaseCurves\Montgomery) {
            throw new \WPMailSMTP\Vendor\phpseclib3\Exception\UnsupportedCurveException('Montgomery Curves are not supported');
        }
        if ($curve instanceof \WPMailSMTP\Vendor\phpseclib3\Crypt\EC\BaseCurves\TwistedEdwards) {
            return self::wrapPrivateKey("\4 " . $secret, [], null, $password, $curve instanceof \WPMailSMTP\Vendor\phpseclib3\Crypt\EC\Curves\Ed25519 ? 'id-Ed25519' : 'id-Ed448');
        }
        $publicKey = "\4" . $publicKey[0]->toBytes() . $publicKey[1]->toBytes();
        $params = new \WPMailSMTP\Vendor\phpseclib3\File\ASN1\Element(self::encodeParameters($curve, \false, $options));
        $key = [
            'version' => 'ecPrivkeyVer1',
            'privateKey' => $privateKey->toBytes(),
            //'parameters' => $params,
            'publicKey' => "\0" . $publicKey,
        ];
        $key = \WPMailSMTP\Vendor\phpseclib3\File\ASN1::encodeDER($key, \WPMailSMTP\Vendor\phpseclib3\File\ASN1\Maps\ECPrivateKey::MAP);
        return self::wrapPrivateKey($key, [], $params, $password, 'id-ecPublicKey', '', $options);
    }
}
