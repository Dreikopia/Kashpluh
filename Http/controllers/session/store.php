<?php

use Core\App;
use Core\Database;
use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);

$login = $_POST['login'];
$password = $_POST['password'];

$form = new LoginForm;

if ($form->validate($login, $password)) {
    if ((new Authenticator)->attempt($login, $password)) {
        redirect('/');
    }
    $form->error('credentials', 'The provided credentials do not match our records.');
}
Session::flash('errors', $form->errors());

Session::flash('old', [
    'login' => $login
]);

redirect('/login');
