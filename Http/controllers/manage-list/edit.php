<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\ExpensesForm;
use Services\ExpenseRepository;

$db = App::resolve(Database::class);
$id = $_POST['id'];

$description = $_POST['description'];
$category = $_POST['category_id'];
$cost = $_POST['cost'];
$date = $_POST['date'];

$form = new ExpensesForm();

if ($form->validate($date, $category, $cost, $description)) {
    (new ExpenseRepository)->update($id, $_POST);
    redirect('/manage-list');
}

Session::flash('errors', $form->errors());
Session::flash('edit_id', $id); //modal errors
redirect('/manage-list');
