<?php

use Core\App;
use Core\Database;
use Core\Authenticator;
use Core\Session;
use Core\ValidationException;
use Http\Forms\RegisterForm;

$db = App::resolve(Database::class);

$form = RegisterForm::validate($attributes = [
    'username' => $_POST['username'],
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

(new Authenticator)->attemptToRegister($attributes['username'], $attributes['email'], $attributes['password']);
redirect('/');
