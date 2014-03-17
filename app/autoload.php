<?php

require_once(__DIR__.'/../vendor/symfony/src/Symfony/Component/ClassLoader/UniversalClassLoader.php');

$loader = new Symfony\Component\ClassLoader\UniversalClassLoader();

// intl
//if (!function_exists('intl_get_error_code')) {
//    require_once __DIR__.'/../vendor/symfony/symfony/src/Symfony/Component/Locale/Resources/stubs/functions.php';
//}

$loader->registerNamespaces(array(
    'Symfony'                            => __DIR__.'/../vendor/symfony/src',
    'Doctrine\\Common'                   => __DIR__.'/../vendor/doctrine-common/lib',
    'Doctrine\\Common\\Annotations'      => __DIR__.'/../vendor/doctrine-annotations/lib',
    'Doctrine\\Common\\Cache'            => __DIR__.'/../vendor/doctrine-cache/lib',
    'Doctrine\\Common\\Collections'      => __DIR__.'/../vendor/doctrine-collections/lib',
    'Doctrine\\ORM'                      => __DIR__.'/../vendor/doctrine/lib',
    'Doctrine\\DBAL'                     => __DIR__.'/../vendor/doctrine-dbal/lib',
    'Doctrine\\DBAL\\Migrations'         => __DIR__.'/../vendor/doctrine-migrations/lib',
    'Doctrine\\Common\\Lexer'            => __DIR__.'/../vendor/doctrine-lexer/lib',
    'Doctrine\\MongoDB'                  => __DIR__.'/../vendor/doctrine-mongodb/lib',
    'Doctrine\\ODM\\MongoDB'             => __DIR__.'/../vendor/doctrine-mongodb-odm/lib',
    'Doctrine\\ODM\\MongoDB\\SoftDelete' => __DIR__.'/../vendor/doctrine-softdelete/lib',
    'Assetic'                            => __DIR__.'/../vendor/assetic/src',
    'Psr'                                => __DIR__.'/../vendor/psr-log',
    'Monolog'                            => __DIR__.'/../vendor/monolog/src',
    'CG'                                 => __DIR__.'/../vendor/cg-library/src',
    'Metadata'                           => __DIR__.'/../vendor/metadata/src',
    'ColdLog'                            => __DIR__.'/../src/',
));

$loader->registerPrefixes(array(
    'Twig_Extensions_' => __DIR__.'/../vendor/twig-extensions/lib',
    'Twig_'            => __DIR__.'/../vendor/twig/lib',
));

$loader->registerPrefixFallbacks(array(
    __DIR__.'/../vendor/symfony/src/Symfony/Component/HttpFoundation/Resources/stubs',
));

$loader->registerNamespaceFallbacks(array(
    __DIR__.'/../vendor/bundles',
));

$loader->register();

use Doctrine\Common\Annotations\AnnotationRegistry;

AnnotationRegistry::registerLoader(function($class) use ($loader) {
    $loader->loadClass($class);
    return class_exists($class, false);
});

AnnotationRegistry::registerFile(__DIR__.'/../vendor/doctrine/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');
AnnotationRegistry::registerFile(__DIR__.'/../vendor/doctrine-mongodb-odm/lib/Doctrine/ODM/MongoDB/Mapping/Annotations/DoctrineAnnotations.php');

return $loader;

