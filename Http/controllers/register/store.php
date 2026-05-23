<?php

use Core\App;
use Core\Database;
use Core\Authenticator;
use Http\Forms\RegistrationForm;

$db = App::resolve(Database::class);

RegistrationForm::validate($attributes = [
    'username' => $_POST['username'],
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

(new Authenticator)->attemptToRegister($attributes['username'], $attributes['email'], $attributes['password']);
redirect('/');
