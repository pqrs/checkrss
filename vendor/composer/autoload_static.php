<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbf4482a851df9181f79093246bc2740d
{
    public static $prefixesPsr0 = array (
        'C' => 
        array (
            'CheckRSS' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitbf4482a851df9181f79093246bc2740d::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
