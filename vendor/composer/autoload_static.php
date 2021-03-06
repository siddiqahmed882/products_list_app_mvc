<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite76066d9e8ad04463bc2e7d715ddd42f
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite76066d9e8ad04463bc2e7d715ddd42f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite76066d9e8ad04463bc2e7d715ddd42f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite76066d9e8ad04463bc2e7d715ddd42f::$classMap;

        }, null, ClassLoader::class);
    }
}
