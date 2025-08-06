<?php

declare(strict_types=1);

/**
 * Front controller for the application.
 */

require dirname(__DIR__) . '/vendor/autoload.php';

use App\Application;

new Application()->run();
