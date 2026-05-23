<?php

use Core\App;
use Core\Database;
use Core\Authenticator;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);


$form = LoginForm::validate($attributes = [
    'login' => $_POST['login'],
    'password' => $_POST['password']
]);

$signedIn = (new Authenticator)->attemptToLogin($attributes['login'], $attributes['password']);

if (! $signedIn) {
    $form->error('credentials', 'The provided credentials do not match our records.')->throw();
    return redirect('/login');
}

if ($signedIn) {
    redirect('/');
}
