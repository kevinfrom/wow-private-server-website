<?php

declare(strict_types=1);

/**
 * Front controller for the application.
 */

const DS = DIRECTORY_SEPARATOR;
define('ROOT_DIR', dirname(__DIR__));
const TEMPLATES_DIR = ROOT_DIR . DS . 'templates';

require ROOT_DIR . DS . 'vendor' . DS . 'autoload.php';

use App\Application;
use League\Container\Container;

$container = new Container();
$container->add(Application::class)->addArgument($container);

/** @var Application $app */
$app = $container->get(Application::class);
$app->run();
