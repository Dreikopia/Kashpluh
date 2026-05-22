<?php

use Core\Response;
use Core\Session;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function base_path($path)
{
    return BASEPATH . $path;
}

function view($path, $data = [])
{
    extract($data);

    return require base_path("views/{$path}");
}

function abort($code = Response::NOT_FOUND)
{
    http_response_code($code);

    require base_path("views/{$code}.php");
    die();
}

function authorize($condition, $status = Response::UNAUTHORIZED)
{
    if ($condition) {
        abort($status);
    }
}

function redirect($path)
{
    header("Location:{$path}");
    exit();
}

function login($user)
{
    $_SESSION['user'] = [
        'login'    => $user['login'] ?? null,
        'username' => $user['username'] ?? null,
        'email'    => $user['email'] ?? null,
    ];
    session_regenerate_id(true);
}

function logout()
{

    Session::destroy();
}

function old($key, $default = '')
{
    return Core\Session::get('old')[$key] ?? $default;
}
