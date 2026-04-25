<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Maintenance Mode
|--------------------------------------------------------------------------
*/

if (file_exists($maintenance = __DIR__ . '/../donasi/storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Autoload Composer
|--------------------------------------------------------------------------
*/

require __DIR__ . '/../donasi/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Bootstrap Laravel
|--------------------------------------------------------------------------
*/

$app = require_once __DIR__ . '/../donasi/bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run App
|--------------------------------------------------------------------------
*/

$app->handleRequest(Request::capture());