<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit8bf67a9d1f00449ff8c7a8583f5d8f4e
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit8bf67a9d1f00449ff8c7a8583f5d8f4e', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit8bf67a9d1f00449ff8c7a8583f5d8f4e', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit8bf67a9d1f00449ff8c7a8583f5d8f4e::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
