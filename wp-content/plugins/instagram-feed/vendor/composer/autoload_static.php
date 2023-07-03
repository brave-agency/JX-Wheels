<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4e34082fb013bad63334b182d1cf5455
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Smashballoon\\Stubs\\' => 19,
        ),
        'I' => 
        array (
            'InstagramFeed\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Smashballoon\\Stubs\\' => 
        array (
            0 => __DIR__ . '/..' . '/smashballoon/stubs/src',
        ),
        'InstagramFeed\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4e34082fb013bad63334b182d1cf5455::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4e34082fb013bad63334b182d1cf5455::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4e34082fb013bad63334b182d1cf5455::$classMap;

        }, null, ClassLoader::class);
    }
}
