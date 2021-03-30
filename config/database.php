<?php

declare(strict_types=1);

use App\Data\Doctrine\Type;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\DBAL;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;

return [
    EntityManagerInterface::class => function () {
        $srcDir = __DIR__ . '/../src';
        $cacheDir = __DIR__ . '/../var/cache/doctrine';

        $config = Setup::createAnnotationMetadataConfiguration(
            [],
            getenv('APP_ENV') === 'test' || getenv('APP_ENV') === 'dev',
            null,
            getenv('APP_ENV') === 'dev' ? null : new FilesystemCache($cacheDir),
            false
        );

        $config->setNamingStrategy(new UnderscoreNamingStrategy());

        // @todo for remove
        $config->addCustomStringFunction('JSON_CONTAINS', Scienta\DoctrineJsonFunctions\Query\AST\Functions\Mysql\JsonContains::class);
        $config->addCustomStringFunction('CAST', Oro\ORM\Query\AST\Functions\Cast::class);

        $types = [
            Type\UrlType::class,
            Type\UuidType::class,

            Type\Language\LanguageNameType::class,
            Type\Language\LanguageCodeType::class,
            Type\Language\LanguageNewFieldType::class
        ];

        foreach ($types as $class) {
            DBAL\Types\Type::addType($class::NAME, $class);
        }

        return EntityManager::create(['url' => getenv('DB_URL')], $config);
    }
];
