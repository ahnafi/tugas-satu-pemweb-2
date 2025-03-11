<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0a6789c916fba676c597c7a9cfd09889
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'sulthon\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'sulthon\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0a6789c916fba676c597c7a9cfd09889::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0a6789c916fba676c597c7a9cfd09889::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0a6789c916fba676c597c7a9cfd09889::$classMap;

        }, null, ClassLoader::class);
    }
}
