<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit704bc0b8a7b0b77ec30db16273abb837
{
    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'Unacurriculos\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Unacurriculos\\' => 
        array (
            0 => __DIR__ . '/..' . '/unacurriculos/php-classes/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Slim' => 
            array (
                0 => __DIR__ . '/..' . '/slim/slim',
            ),
        ),
        'R' => 
        array (
            'Rain' => 
            array (
                0 => __DIR__ . '/..' . '/rain/raintpl/library',
            ),
        ),
    );

    public static $classMap = array (
        'EasyPeasyICS' => __DIR__ . '/..' . '/phpmailer/phpmailer/extras/EasyPeasyICS.php',
        'PHPMailer' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmailer.php',
        'PHPMailerOAuth' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmaileroauth.php',
        'PHPMailerOAuthGoogle' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmaileroauthgoogle.php',
        'POP3' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.pop3.php',
        'SMTP' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.smtp.php',
        'ntlm_sasl_client_class' => __DIR__ . '/..' . '/phpmailer/phpmailer/extras/ntlm_sasl_client.php',
        'phpmailerException' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmailer.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit704bc0b8a7b0b77ec30db16273abb837::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit704bc0b8a7b0b77ec30db16273abb837::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit704bc0b8a7b0b77ec30db16273abb837::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit704bc0b8a7b0b77ec30db16273abb837::$classMap;

        }, null, ClassLoader::class);
    }
}
