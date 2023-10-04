<?php

namespace App\Rules;

use App\Constant;
use Carbon\Carbon;
use App\Models\Reservation;
use Illuminate\Contracts\Validation\Rule;

class CheckReservationAvailability implements Rule
{
    private $room_id;
    private $reservation_check_in;
    private $reservation_check_out;
    public function __construct($room_id, $reservation_check_in, $reservation_check_out)
    {
        $this->room_id = $room_id;
        $this->reservation_check_in = Carbon::parse($reservation_check_in);
        $this->reservation_check_out = Carbon::parse($reservation_check_out);
    }


    public function passes($attribute, $value)
    {
        $conflictingReservations = Reservation::where('room_id', $this->room_id)
                                ->where('status', '=', Constant::RESERVATION_AVALIABLE)
                                ->where(function ($query) {
                                $query->whereBetween('checkin', [$this->reservation_check_in, $this->reservation_check_out])
                                ->orWhereBetween('checkout', [$this->reservation_check_in, $this->reservation_check_out])
                                ->orWhere(function ($query) {
                                $query->where('checkin', '<=', $this->reservation_check_in)
                                ->where('checkout', '>=', $this->reservation_check_out);
                                });
                                })
                                ->whereNull('deleted_at')
                                ->count();

        return $conflictingReservations === 0;
    }

    public function message()
    {
        back()->with('Sorry! ', 'This room is Already taken! Please Choose Other date or Other rooms');
    }
}