<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit95f11cbac70aece50a0e92feb82c8a8c
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Faker\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fzaninotto/faker/src/Faker',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit95f11cbac70aece50a0e92feb82c8a8c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit95f11cbac70aece50a0e92feb82c8a8c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
