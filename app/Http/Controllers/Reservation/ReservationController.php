<?php

namespace App\Http\Controllers\Reservation;

use App\Utility;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\ReservationConfirmRequest;
use App\Models\Reservation;
use App\Repository\Reservation\ReservationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Constant;
use App\ReturnMessage;

class ReservationController extends Controller
{
    private $ReservationRepository;
    public function __construct(ReservationRepositoryInterface $ReservationRepository){
        $this->ReservationRepository = $ReservationRepository;
        DB::connection()->enableQueryLog();
    }
    public function ReservationListing() {
        try {
            $reservations = $this->ReservationRepository->getReservation();
            return view('backend.Reservation.Listing',compact(['reservations']));
        } catch (\Exception $e) {
            $logs = "View sreen create::";
            $logs = $e->getMessage();
            Utility::saveErrorLog($logs);
            abort(500);
        }
    }
    public function ReservationConfrim($id) {
        $reservation = Reservation::find($id);
        $room_id = $reservation->room_id;
        $checkin = $reservation->checkin;
        $checkout = $reservation->checkout;
        $checkin_cnt = Reservation::where('checkin','<',$checkin)
                       ->where('checkout','>',$checkin)
                       ->where('status',Constant::RESERVATION_AVALIABLE)
                       ->where('room_id',$room_id)
                       ->whereNull('deleted_at')
                       ->count();
        $checkout_cnt =  Reservation::where('checkin','<',$checkout)
                        ->where('checkout','>',$checkout)
                        ->where('status',Constant::RESERVATION_AVALIABLE)
                        ->where('room_id',$room_id)
                        ->whereNull('deleted_at')
                        ->count();
        if($checkin_cnt === 0 && $checkout_cnt === 0) {
            $reservation->status = Constant::RESERVATION_AVALIABLE;
            $reservation->save();
            return back()->with('success', 'Reservation confirmed successful.');
        } else {
            return "something wrong";
        }
    }
    public function delete($id){
        try{
            $result = $this->ReservationRepository->delete($id);
            $logs   = "reservation sreen delete::";
            Utility::saveDebugLog($logs);
            if($result['softGuideStatusCode'] == ReturnMessage::OK ){
                return back()->with('success', 'Reservation Reject successful.');
            } else {
                return back()->with('error', 'Something wrong.');

            }
        } catch(\Exception $e) {
            $logs = "reservation sreen delete::";
            $logs = $e->getMessage();
            Utility::saveErrorLog($logs);
            abort(500);
        }
    }
}
