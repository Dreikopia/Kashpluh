<?php

namespace Http\Forms;

use Core\Validator;
use Core\ValidationException;

class RegistrationForm
{
    public $errors = [];

    public function __construct(public array $attributes)
    {
        if (! Validator::empty($attributes['username'])) {
            $this->errors['username'] = "Required";
        }
        if (! Validator::empty($attributes['email'])) {
            $this->errors['email'] = "Required";
        }

        if (! Validator::empty($attributes['password'])) {
            $this->errors['password'] = "Required";
        }
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);

        if ($instance->failed()) {
            ValidationException::throw($instance->errors(), $instance->attributes);
        }

        return $instance;
    }

    public function failed()
    {
        return count($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }
}
