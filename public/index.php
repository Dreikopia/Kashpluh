<?php

use Core\Session;
use Core\ValidationException;

session_start();

const BASEPATH = __DIR__ . '/../';

require BASEPATH . 'Core/function.php';

require base_path('vendor/autoload.php'); // replaces spl autoload

// spl_autoload_register(function ($class) {
//     $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
//     require base_path("{$class}.php");
// });

require base_path('bootstrap.php');

$router = new Core\Router;

$routes = require base_path('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD']; //used the override method or the req method


try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {

    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    redirect($router->prevUrl());
}
Session::unflash();
