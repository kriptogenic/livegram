<?php
declare(strict_types=1);

use DI\ContainerBuilder;

if(getenv('DEBUG') === 'true') {
    error_reporting(E_ALL );

}

define('APP_DIR', __DIR__ . '/');
require APP_DIR . 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createMutable(APP_DIR);
$dotenv->load();

$builder = new ContainerBuilder();
$builder->addDefinitions(APP_DIR . 'service.php');

$container = $builder->build();
