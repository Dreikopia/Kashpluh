<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
    protected $errors = [];

    public function __construct(public array $attributes)
    {
        if (! Validator::empty($attributes['login'])) {
            $this->errors['login'] = "Required";
        }

        if (! Validator::empty($attributes['password'])) {
            $this->errors['password'] = "Required";
        }
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance; //if there is an errors throw an exception
    }

    public function throw() //manually throw the exeception for add error because the validate automatically throws we need a way no manually throw an exception
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }

    public function failed() //if has an errors
    {
        return count($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function error($field, $message)
    {
        $this->errors[$field] = $message;

        return $this; //to allow chaining in the controller
    }
}
