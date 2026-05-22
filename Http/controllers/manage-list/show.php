<?php

use Services\ExpenseRepository;

$repo = new ExpenseRepository;

$expenses = $repo->all();
$categories = $repo->allcategories();

view('manage-list/show.view.php', [
    'expenses' => $expenses,
    'categories' => $categories
]);

//use prg and add validations