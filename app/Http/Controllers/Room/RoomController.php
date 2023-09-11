<?php

namespace App\Http\Controllers\Room;
use App\Utility;
use App\ReturnMessage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomRequest;
use App\Repository\Room\RoomRepositoryInterface;
use App\Repository\Bed\BedRepositoryInterface;
use App\Repository\Amenity\AmenityRepositoryInterface;
use App\Repository\View\ViewRepositoryInterface;
use App\Repository\Feature\FeatureRepositoryInterface;

class RoomController extends Controller
{
    private $RoomRepository;
    private $BedRepository;
    private $AmenityRepository;
    private $ViewRepository;
    private $FeatureRepository;
    public function __construct(
            BedRepositoryInterface $BedRepository,
            AmenityRepositoryInterface $AmenityRepository,
            ViewRepositoryInterface $ViewRepository,
            FeatureRepositoryInterface $FeatureRepository,
            RoomRepositoryInterface $RoomRepository,
        ){
            $this->BedRepository = $BedRepository;
            $this->ViewRepository = $ViewRepository;
            $this->AmenityRepository = $AmenityRepository;
            $this->FeatureRepository = $FeatureRepository;
            $this->RoomRepository = $RoomRepository;
            DB::connection()->enableQueryLog();
    }
    public function RoomListing(){
        try{
            $Room_data = $this->RoomRepository->getRoom();
            $logs = "Room screen Listing::";
            Utility::saveDebugLog($logs);
            return view('backend.Room.listing',compact(['Room_data']));
        } catch(\Exception $e){
            $logs = "Room screen Listing::";
            $logs = $e->getMessage();
            Utility::saveErrorLog($logs);
            abort(500);
        }
        
    }
    public function RoomForm(){ 
        $roomBed      = $this->BedRepository->getBed();
        $roomView     = $this->ViewRepository->getView();
        $roomAmenity  = $this->AmenityRepository->getAmenity();
        $roomFeature  = $this->FeatureRepository->getFeature();
        return view('backend.Room.Form',compact(['roomBed','roomView','roomAmenity','roomFeature']));
    }
    public function RoomCreate(RoomRequest $request){
        try{
            $result = $this->RoomRepository->RoomCreate($request->all());
            $logs = "Room sreen create::";
            Utility::saveDebugLog($logs);
            if($result['softGuideStatusCode'] == ReturnMessage::OK){
                $insertRoomId = $result['insertedRoomId'];
                return redirect('admin-backend/room/roomGallery/'.$insertRoomId)->with('success','Create Data successful.');
            } else {
                return redirect()->route('RoomForm')->with('error','Something wrong.');
            }
        } catch(\Exception $e) {
            $logs = "Room sreen create::";
            $logs = $e->getMessage();
            Utility::saveErrorLog($logs);
            abort(500);
        }
    }
    public function galleryCreate($id){
        return view('backend.Room.roomGallery');
    }

    public function RoomEdit($id){
        $Room_data = $this->RoomRepository->RoomEdit($id);
        return view('backend.Room.form',compact(['Room_data']));
        
    }
    public function RoomUpdate(RoomRequest $request){
        
        try{
            $result = $this->RoomRepository->update($request->all());
            $logs   = "Room sreen Update::";
            Utility::saveDebugLog($logs);
            if($result['softGuideStatusCode'] == ReturnMessage::OK ){
                return redirect()->route('RoomListing')->with('success','Update Data successful.');
            } else {
                return redirect()->route('RoomListing')->with('error','Update Data successful.');
            }
        } catch(\Exception $e) {
            $logs = "Room sreen Update::";
            $logs = $e->getMessage();
            Utility::saveErrorLog($logs);
            abort(500);
        }
    }
    public function Roomdelete($id){
        try{
            $result = $this->RoomRepository->delete($id);
            $logs   = "Room sreen delete::";
            Utility::saveDebugLog($logs);
            if($result['softGuideStatusCode'] == ReturnMessage::OK ){
                return redirect()->route('RoomListing')->with('success','Delete Data successful.');
            } else {
                return redirect()->route('RoomListing')->with('error','Update Data successful.');

            }
        } catch(\Exception $e) {
            $logs = "Room sreen delete::";
            $logs = $e->getMessage();
            Utility::saveErrorLog($logs);
            abort(500);
        }
    }

}
