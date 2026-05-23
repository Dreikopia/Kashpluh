<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Core\Authenticator;

$db = App::resolve(Database::class);

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if (! Validator::empty($username)) {
    $errors['username'] = "Required";
}
if (! Validator::empty($email)) {
    $errors['email'] = "Required";
}

if (! Validator::empty($password)) {
    $errors['password'] = "Required";
}

if (! empty($errors)) {
    view('register/create.view.php', [
        'errors' => $errors
    ]);
    exit();
} else {


    (new Authenticator)->attemptToRegister($username, $email, $password);
    // $query = "INSERT INTO users(username, email, pwd)
    // VALUES(:username, :email, :pwd)";


    // $db->query($query, [
    //     ':username' => $username,
    //     ':email' => $email,
    //     ':pwd' => password_hash($password, PASSWORD_BCRYPT)
    // ]);

    // login([
    //     'username' => $username,
    //     'email' => $email
    // ]);

    redirect('/');
}
