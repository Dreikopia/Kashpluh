<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\ExpensesForm;
use Services\ExpenseRepository;

$db = App::resolve(Database::class);


$date = $_POST['date'];
$category = $_POST['category_id'];
$cost = $_POST['cost'];
$description = $_POST['description'];


$form = new ExpensesForm;

if ($form->validate($date, $category, $cost, $description)) {
    if ((new ExpenseRepository)->create($date, $category, $cost, $description)) {
        redirect('/expenses');
    }
}

Session::flash('errors', $form->errors());

Session::flash('old', [
    'category_id' => $category,
    'cost' => $cost,
    'description' => $description
]);

redirect('/expenses');
