<?php

declare(strict_types=1);

use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\ConfigurationArray;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Tools\Console\Command as DoctrineMigrationCommands;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Doctrine\ORM\Tools\Console\Command as DoctrineORMCommands;
use Doctrine\ORM\Tools\Console\Command\ClearCache as ClearCache;
use App\UI\Console;

define('APP_CONSOLE', true);

/** @var ContainerInterface $container */
$container = require_once __DIR__. '/../config/bootstrap.php';

$cli = new Application('Application Console');

/** @var EntityManagerInterface $entityManager */
$entityManager = $container->get(EntityManagerInterface::class);

$connection = $entityManager->getConnection();

$config = new ConfigurationArray([
    'migrations_paths' => [
        'App\Data\Migrations' => __DIR__ . '/../src/Data/Migrations'
    ]
]);

$dependencyFactory = DependencyFactory::fromEntityManager(
    $config,
    new ExistingEntityManager($entityManager)
);

$cli->addCommands(array(
    new DoctrineMigrationCommands\DiffCommand($dependencyFactory),
    new DoctrineMigrationCommands\ExecuteCommand($dependencyFactory),
    new DoctrineMigrationCommands\GenerateCommand($dependencyFactory),
    new DoctrineMigrationCommands\LatestCommand($dependencyFactory),
    new DoctrineMigrationCommands\ListCommand($dependencyFactory),
    new DoctrineMigrationCommands\MigrateCommand($dependencyFactory),
    new DoctrineMigrationCommands\RollupCommand($dependencyFactory),
    new DoctrineMigrationCommands\StatusCommand($dependencyFactory),
    new DoctrineMigrationCommands\VersionCommand($dependencyFactory),
));

$exitCode = $cli->run();

exit($exitCode);
