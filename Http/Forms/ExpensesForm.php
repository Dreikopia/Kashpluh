<?php

namespace Http\Forms;

use Core\Validator;

class ExpensesForm
{
    protected $errors = [];

    public function validate($date, $category, $cost, $description)
    {

        if (! Validator::empty($category)) {
            $this->errors['category'] = 'Required';
        }
        if (!Validator::integerMin($cost, 1)) {
            $this->errors['cost'] = 'Cost must be at least 1';
        }
        if (! Validator::date($date)) {
            $this->errors['date'] = "Date cannot be in the future and less than 1 year";
        }
        if (! Validator::string($description, 0, 250)) {
            $this->errors['description_len'] = 'Description must be no exceed 250 characters';
        }

        return empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }
}
