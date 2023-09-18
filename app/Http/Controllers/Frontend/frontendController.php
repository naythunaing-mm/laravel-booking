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
}
