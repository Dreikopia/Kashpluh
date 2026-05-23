<?php

namespace Core;

use Core\App;
use Core\Database;

class Authenticator
{
    public Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function attemptToRegister($username, $email, $password)
    {
        $this->db->query("INSERT INTO users(username, email, pwd)
        VALUES(:username, :email, :pwd)", [
            ':username' => $username,
            ':email' => $email,
            ':pwd' => password_hash($password, PASSWORD_BCRYPT)
        ]);
        $this->login([
            'username' => $username,
            'email' => $email
        ]);
    }

    public function attemptToLogin($login, $password)
    {
        $user = $this->db
            ->query("SELECT * FROM users WHERE email = :email OR username = :username", [
                ':username' => $login,
                ':email'    => $login,
            ])
            ->find();

        if ($user && password_verify($password, $user['pwd'])) {
            $this->login(['login' => $login]);
            return true;
        }

        return false;
    }



    public function login($user)
    {
        $_SESSION['user'] = [
            'login'    => $user['login'] ?? null,
            'username' => $user['username'] ?? null,
            'email'    => $user['email'] ?? null,
        ];
        session_regenerate_id(true);
    }

    public function logout()
    {

        Session::destroy();
    }
}
