<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitca11d350c39e0261c539f7266c3b4553
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'ReCaptcha\\' => 10,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'C' => 
        array (
            'Cubes\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ReCaptcha\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/recaptcha/src/ReCaptcha',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Cubes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Cubes',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitca11d350c39e0261c539f7266c3b4553::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitca11d350c39e0261c539f7266c3b4553::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}