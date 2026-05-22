<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$query = "SELECT * FROM categories";

$categories = $db->query($query)->findAll();

view('expenses/create.view.php', [
    'errors' => Session::get('errors'),
    'categories' => $categories
]);
