<?php

namespace Core;

use Core\App;
use Core\Database;

class Authenticator
{
    public function attempt($login, $password)
    {
        App::resolve(Database::class);

        $query = "SELECT * FROM users WHERE email = :email OR username = :username";

        $user = App::resolve(Database::class)->query($query, [
            ':username' => $login,
            ':email' => $login,
        ])->find();

        if ($user) {
            if (password_verify($password, $user['pwd'])) {

                login([
                    'login' => $login
                ]);

                return true;
            }
        }
        return false;
    }
}
