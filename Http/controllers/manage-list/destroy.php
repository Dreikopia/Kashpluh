<?php

use Services\ExpenseRepository;

$id = $_POST['id'];

(new ExpenseRepository)->delete($id);

redirect('/manage-list');
