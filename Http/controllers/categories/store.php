<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$category = $_POST['category_name'];

$query = "INSERT INTO categories (category_name)
                        VALUES(:category_name)";

$category = $db->query($query, [
    ':category_name' => $category
]);

redirect('/expenses');
