<?php

$domains = array(
    'www.tuxauto.com', 'tuxauto.com', 'dev.tuxauto.builtbybrave.com', 
    'www.rivierawheels.co.uk', 'rivierawheels.co.uk', 'dev.rivierawheels.builtbybrave.com', 
    'www.stuttgartwheels.co.uk', 'stuttgartwheels.co.uk', 'dev.stuttgartwheels.builtbybrave.com ',
    'www.lmrwheels.co.uk', 'lmrwheels.co.uk', 'dev.lmrwheels.builtbybrave.com ',
);


#dev.tuxauto.builtbybrave.com 

if (in_array($_SERVER['HTTP_HOST'], $domains))
{
    $domain = $_SERVER['HTTP_HOST'];
}
else 
{
    $domain = 'localhost';
}

// ***********************************************************************//
// PRODUCTION

if(  $domain === 'www.tuxauto.com' ||  $domain === 'tuxauto.com' || $domain === 'www.rivierawheels.co.uk' || $domain === 'rivierawheels.co.uk' || $domain === 'www.stuttgartwheels.co.uk' || $domain === 'stuttgartwheels.co.uk' || $domain === 'www.lmrwheels.co.uk' || $domain === 'lmrwheels.co.uk') :

// ***********************************************************************//
// DEVELOPMENT

elseif( $domain === 'dev.tuxauto.builtbybrave.com' || $domain === 'dev.rivierawheels.builtbybrave.com' || $domain === 'dev.stuttgartwheels.builtbybrave.com' || $domain === 'dev.lmrwheels.builtbybrave.com' ) :

    define('DB_NAME', 'tuxauto');
    define('DB_USER', 'tuxauto');
    define('DB_PASSWORD', 'F6UA6UOVJieeo9gS');
    define('DB_HOST', 'devdb1.brave.agency');
    define('DB_CHARSET', 'utf8mb4');
    define('DB_COLLATE', '');

// ***********************************************************************//
// LOCAL
else :

    define('DB_NAME', 'tuxauto');
    define('DB_USER', 'tuxauto');
    define('DB_PASSWORD', 'F6UA6UOVJieeo9gS');
    define('DB_HOST', 'devdb1.brave.agency');
    define('DB_CHARSET', 'utf8mb4');
    define('DB_COLLATE', '');

// ***********************************************************************//

endif;

$table_prefix  = 'wp_tuxauto';

define( 'WP_ALLOW_MULTISITE', true );
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', true);
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);
define('COOKIE_DOMAIN', false);

define( 'DIEONDBERROR', true );

define('AUTH_KEY',         'e`;K<Nojec++(2gv)RKm4M>Oix,#IksAAlQ2Q0)a8Y&Ptt7.ohro9DC]8Kos>r$y');
define('SECURE_AUTH_KEY',  'Qr@HHhFStUze;*rvH0s^Z2.V^@-y7,d<^+@`k,x#Z`b9,E&u481U/`1*&Z-IiLmm');
define('LOGGED_IN_KEY',    '+%E6+?r~sn;Q-u6zFam9]W|_[*L<e@)Z%VU{(34^~82Q+8q_9mDJgl#)WZ08<l4t');
define('NONCE_KEY',        'UlV<,Kq7D/UMOh|0R?HuRNA8~v*)NGJ:=+|@.|H<$1>!y<S-X>;+z%U/q6,%-wt+');
define('AUTH_SALT',        'JEv6DuJ=8bm-+dI=:7LA9?`)_iuFDm^3M!xF- TJM+;)+^pK<QAn1E6z]t4wU82S');
define('SECURE_AUTH_SALT', '@VYw~Uq`--tL|3<w(l-2(s%Dpe$kn93n>Q<jE4MwBptPKG$q<i.h)!7a9ifKscs[');
define('LOGGED_IN_SALT',   '+PrQk!USHBBg7Wh,KN}p)9HU.pkYJwVD_a|U3+bn&<<E]XNJYKQ-{{C UqBZ&8+B');
define('NONCE_SALT',       'nCoCBQ6ha1fnVJ/,++Z^4x&7Zf0_5^cTHngZKut%wZZ,W38SN{@:H=g-~jQ% &wT');

define( 'WP_DEBUG', true );

if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

require_once( ABSPATH . 'wp-settings.php' );