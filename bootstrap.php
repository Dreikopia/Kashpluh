<?php

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container;

App::setContainer($container); //pass the container to the app

App::bind('Core\Database', function () { // binds the key and the function
    $config = require base_path('config.php');
    return new Database($config['database']);
});
