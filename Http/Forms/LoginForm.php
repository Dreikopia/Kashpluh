<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm
{
    protected $errors = [];
    //returns if error is empty
    public function validate($login, $password)
    {
        if (! Validator::empty($login)) {
            $this->errors['login'] = "Required";
        }

        if (! Validator::empty($password)) {
            $this->errors['password'] = "Required";
        }
        return empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function error($field, $message)
    {
        $this->errors[$field] = $message;
    }
}
