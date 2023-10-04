<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class CheckInDateBeforeCheckOutDate implements Rule
{
    public function passes($attribute, $value)
    {
        $checkInDate = Carbon::parse(request()->input('checkin'));
        $checkOutDate = Carbon::parse($value);

        return $checkInDate < $checkOutDate;
    }

    public function message()
    {
        return 'The check-in date must be before the checkout date.';
    }
}