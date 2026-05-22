<?php

$router->get('/', 'dashboard.php')->only('auth');

$router->get('/expenses', 'expenses/create.php')->only('auth');
$router->post('/expenses', 'expenses/store.php');

$router->post('/categories', 'categories/store.php');

$router->get('/manage-list', 'manage-list/show.php')->only('auth');
$router->patch('/manage-list', 'manage-list/edit.php')->only('auth');
$router->delete('/manage-list', 'manage-list/destroy.php')->only('auth');

$router->get('/settings', 'settings.php')->only('auth');

//Auth
$router->get('/register', 'register/create.php')->only('guest');
$router->post('/register', 'register/store.php');

$router->get('/login', 'session/create.php')->only('guest');
$router->post('/login', 'session/store.php');

$router->delete('/login', 'session/destroy.php');
