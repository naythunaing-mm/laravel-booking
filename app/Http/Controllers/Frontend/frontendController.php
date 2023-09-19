<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repository\Room\RoomRepositoryInterface;

class frontendController extends Controller
{
    private $RoomRepository;
    public function __construct(
        RoomRepositoryInterface $RoomRepository) {
            $this->RoomRepository = $RoomRepository;
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
        $rooms_data = $this->RoomRepository->rooms();
        return view('frontend.room.rooms',compact(['rooms_data']));
    }
}
