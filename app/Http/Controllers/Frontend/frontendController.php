<?php

namespace App\Http\Controllers\Frontend;
use App\Utility;
use App\ReturnMessage;
use Illuminate\Http\Request;
use App\Http\Requests\Reservation\ReservationRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Search\RoomSearchRequest;
use App\Repository\Room\RoomRepositoryInterface;
use App\Repository\Reservation\ReservationRepositoryInterface;

class frontendController extends Controller
{
    private $RoomRepository;
    private $ReservationRepository;
    public function __construct(
        RoomRepositoryInterface $RoomRepository,
        ReservationRepositoryInterface $ReservationRepository,) {
            $this->RoomRepository = $RoomRepository;
            $this->ReservationRepository = $ReservationRepository;
            DB::connection()->enableQueryLog();
        }
    public function index() {
        $rooms = $this->RoomRepository->roomRandomById();
        return view('frontend.home.index',compact(['rooms']));
    }
    public function about() {
        return view('frontend.layouts.partial.about');
    }
    public function contact() {
        return view('frontend.layouts.partial.contact');
    }
    public function frontendDetail($id) {
        $amenity_data = $this->RoomRepository->roomAmenityByroomId($id);
        $feature_data = $this->RoomRepository->roomFeatureByroomId($id);
        $room = $this->RoomRepository->RoomEdit($id);
        return view('frontend.room.roomDetail',compact(['room','amenity_data','feature_data']));
    }
    public function rooms() {
        try {
            $rooms_data = $this->RoomRepository->rooms();
            return view('frontend.room.rooms',compact(['rooms_data']));
        } catch(\Exception $e) {
            $logs = "Room Reserve::";
            $logs = $e->getMessage();
            Utility::saveErrorLog($logs);
            abort(500);
        }
        
    }
    public function roomReserve($id) {
        try{
            $rooms = $this->RoomRepository->RoomEdit($id);
            return view('frontend.room.roomReserve',compact(['rooms']));
        } catch(\Exception $e) {
            $logs = "Room Reserve::";
            $logs = $e->getMessage();
            Utility::saveErrorLog($logs);
            abort(500);
        }
        
    }
    public function roomReserved(ReservationRequest $request) {
        try{
            $result = $this->ReservationRepository->reserve($request->all());
            $logs   = "Room Room Reserve Create::";
            Utility::saveDebugLog($logs);
            if($result['softGuideStatusCode'] == ReturnMessage::OK ){
                return back()->with('success', 'Reservation successful! Please wait for contact for the administrator');
            } else {
                return back()->with('error', 'Reservation failed. Please Choose other date or other rooms');
            }
        } catch(\Exception $e) {
            $logs = "Room Reserve::";
            $logs = $e->getMessage();
            Utility::saveErrorLog($logs);
            abort(500);
        }
    }
    public function RoomSearch(RoomSearchRequest $request) {
        try{
            $rooms = $this->RoomRepository->roomSearch($request->all());
            $logs   = "Room Search::";
            Utility::saveDebugLog($logs);
            return view('frontend.room.roomSearch',compact('rooms'));
        } catch(\Exception $e) {
            $logs = "Room Search::";
            $logs = $e->getMessage();
            Utility::saveErrorLog($logs);
            abort(500);
        }
    }   
}
