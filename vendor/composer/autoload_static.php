<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita7597a2c9143a6d985081b16f2e828c0
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Blog\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Blog\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita7597a2c9143a6d985081b16f2e828c0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita7597a2c9143a6d985081b16f2e828c0::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
