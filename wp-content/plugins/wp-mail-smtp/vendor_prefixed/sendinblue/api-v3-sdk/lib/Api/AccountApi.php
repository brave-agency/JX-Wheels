<?php

/**
 * AccountApi
 * PHP version 5
 *
 * @category Class
 * @package  SendinBlue\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
/**
 * SendinBlue API
 *
 * SendinBlue provide a RESTFul API that can be used with any languages. With this API, you will be able to :   - Manage your campaigns and get the statistics   - Manage your contacts   - Send transactional Emails and SMS   - and much more...  You can download our wrappers at https://github.com/orgs/sendinblue  **Possible responses**   | Code | Message |   | :-------------: | ------------- |   | 200  | OK. Successful Request  |   | 201  | OK. Successful Creation |   | 202  | OK. Request accepted |   | 204  | OK. Successful Update/Deletion  |   | 400  | Error. Bad Request  |   | 401  | Error. Authentication Needed  |   | 402  | Error. Not enough credit, plan upgrade needed  |   | 403  | Error. Permission denied  |   | 404  | Error. Object does not exist |   | 405  | Error. Method not allowed  |   | 406  | Error. Not Acceptable  |
 *
 * OpenAPI spec version: 3.0.0
 * Contact: contact@sendinblue.com
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.12
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */
namespace WPMailSMTP\Vendor\SendinBlue\Client\Api;

use WPMailSMTP\Vendor\GuzzleHttp\Client;
use WPMailSMTP\Vendor\GuzzleHttp\ClientInterface;
use WPMailSMTP\Vendor\GuzzleHttp\Exception\RequestException;
use WPMailSMTP\Vendor\GuzzleHttp\Psr7\MultipartStream;
use WPMailSMTP\Vendor\GuzzleHttp\Psr7\Request;
use WPMailSMTP\Vendor\GuzzleHttp\RequestOptions;
use WPMailSMTP\Vendor\SendinBlue\Client\ApiException;
use WPMailSMTP\Vendor\SendinBlue\Client\Configuration;
use WPMailSMTP\Vendor\SendinBlue\Client\HeaderSelector;
use WPMailSMTP\Vendor\SendinBlue\Client\ObjectSerializer;
/**
 * AccountApi Class Doc Comment
 *
 * @category Class
 * @package  SendinBlue\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class AccountApi
{
    /**
     * @var ClientInterface
     */
    protected $client;
    /**
     * @var Configuration
     */
    protected $config;
    /**
     * @var HeaderSelector
     */
    protected $headerSelector;
    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     */
    public function __construct(\WPMailSMTP\Vendor\GuzzleHttp\ClientInterface $client = null, \WPMailSMTP\Vendor\SendinBlue\Client\Configuration $config = null, \WPMailSMTP\Vendor\SendinBlue\Client\HeaderSelector $selector = null)
    {
        $this->client = $client ?: new \WPMailSMTP\Vendor\GuzzleHttp\Client();
        $this->config = $config ?: new \WPMailSMTP\Vendor\SendinBlue\Client\Configuration();
        $this->headerSelector = $selector ?: new \WPMailSMTP\Vendor\SendinBlue\Client\HeaderSelector();
    }
    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }
    /**
     * Operation getAccount
     *
     * Get your account information, plan and credits details
     *
     *
     * @throws \SendinBlue\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \SendinBlue\Client\Model\GetAccount
     */
    public function getAccount()
    {
        list($response) = $this->getAccountWithHttpInfo();
        return $response;
    }
    /**
     * Operation getAccountWithHttpInfo
     *
     * Get your account information, plan and credits details
     *
     *
     * @throws \SendinBlue\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \SendinBlue\Client\Model\GetAccount, HTTP status code, HTTP response headers (array of strings)
     */
    public function getAccountWithHttpInfo()
    {
        $returnType = 'WPMailSMTP\\Vendor\\SendinBlue\\Client\\Model\\GetAccount';
        $request = $this->getAccountRequest();
        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (\WPMailSMTP\Vendor\GuzzleHttp\Exception\RequestException $e) {
                throw new \WPMailSMTP\Vendor\SendinBlue\Client\ApiException("[{$e->getCode()}] {$e->getMessage()}", $e->getCode(), $e->getResponse() ? $e->getResponse()->getHeaders() : null, $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null);
            }
            $statusCode = $response->getStatusCode();
            if ($statusCode < 200 || $statusCode > 299) {
                throw new \WPMailSMTP\Vendor\SendinBlue\Client\ApiException(\sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }
            $responseBody = $response->getBody();
            if ($returnType === '\\SplFileObject') {
                $content = $responseBody;
                //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = \json_decode($content);
                }
            }
            return [\WPMailSMTP\Vendor\SendinBlue\Client\ObjectSerializer::deserialize($content, $returnType, []), $response->getStatusCode(), $response->getHeaders()];
        } catch (\WPMailSMTP\Vendor\SendinBlue\Client\ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = \WPMailSMTP\Vendor\SendinBlue\Client\ObjectSerializer::deserialize($e->getResponseBody(), 'WPMailSMTP\\Vendor\\SendinBlue\\Client\\Model\\GetAccount', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }
    /**
     * Operation getAccountAsync
     *
     * Get your account information, plan and credits details
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAccountAsync()
    {
        return $this->getAccountAsyncWithHttpInfo()->then(function ($response) {
            return $response[0];
        });
    }
    /**
     * Operation getAccountAsyncWithHttpInfo
     *
     * Get your account information, plan and credits details
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAccountAsyncWithHttpInfo()
    {
        $returnType = 'WPMailSMTP\\Vendor\\SendinBlue\\Client\\Model\\GetAccount';
        $request = $this->getAccountRequest();
        return $this->client->sendAsync($request, $this->createHttpClientOption())->then(function ($response) use($returnType) {
            $responseBody = $response->getBody();
            if ($returnType === '\\SplFileObject') {
                $content = $responseBody;
                //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = \json_decode($content);
                }
            }
            return [\WPMailSMTP\Vendor\SendinBlue\Client\ObjectSerializer::deserialize($content, $returnType, []), $response->getStatusCode(), $response->getHeaders()];
        }, function ($exception) {
            $response = $exception->getResponse();
            $statusCode = $response->getStatusCode();
            throw new \WPMailSMTP\Vendor\SendinBlue\Client\ApiException(\sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
        });
    }
    /**
     * Create request for operation 'getAccount'
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getAccountRequest()
    {
        $resourcePath = '/account';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = \false;
        // body params
        $_tempBody = null;
        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(['application/json']);
        } else {
            $headers = $this->headerSelector->selectHeaders(['application/json'], ['application/json']);
        }
        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            if ($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \WPMailSMTP\Vendor\GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if (\is_array($httpBody)) {
                    $httpBody = \WPMailSMTP\Vendor\GuzzleHttp\json_encode(\WPMailSMTP\Vendor\SendinBlue\Client\ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (\count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = ['name' => $formParamName, 'contents' => $formParamValue];
                }
                // for HTTP post (form)
                $httpBody = new \WPMailSMTP\Vendor\GuzzleHttp\Psr7\MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \WPMailSMTP\Vendor\GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \WPMailSMTP\Vendor\GuzzleHttp\Psr7\Query::build($formParams);
            }
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('api-key');
        if ($apiKey !== null) {
            $headers['api-key'] = $apiKey;
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('partner-key');
        if ($apiKey !== null) {
            $headers['partner-key'] = $apiKey;
        }
        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }
        $headers = \array_merge($defaultHeaders, $headerParams, $headers);
        $query = \WPMailSMTP\Vendor\GuzzleHttp\Psr7\Query::build($queryParams);
        return new \WPMailSMTP\Vendor\GuzzleHttp\Psr7\Request('GET', $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''), $headers, $httpBody);
    }
    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[\WPMailSMTP\Vendor\GuzzleHttp\RequestOptions::DEBUG] = \fopen($this->config->getDebugFile(), 'a');
            if (!$options[\WPMailSMTP\Vendor\GuzzleHttp\RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }
        return $options;
    }
}
