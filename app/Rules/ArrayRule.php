<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ArrayRule implements Rule
{
    public function passes($attribute, $value)
    {
        return is_array($value);
    }

    public function message()
    {
        return 'The :attribute must be an array.';
    }
}
