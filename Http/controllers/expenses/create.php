<?php

use Core\Session;
use Services\CategoryRepository;


$categories = (new CategoryRepository)->all();

view('expenses/create.view.php', [
    'errors' => Session::get('errors'),
    'categories' => $categories
]);
