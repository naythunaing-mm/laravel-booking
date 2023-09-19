<?php

namespace App\Http\Controllers\Room;
use App\Utility;
use App\ReturnMessage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomRequest;
use App\Http\Requests\Room\RoomUpdateRequest;
use App\Repository\Bed\BedRepositoryInterface;
use App\Repository\Room\RoomRepositoryInterface;
use App\Repository\View\ViewRepositoryInterface;
use App\Http\Requests\roomGallery\roomGalleryRequest;
use App\Repository\Amenity\AmenityRepositoryInterface;
use App\Repository\Feature\FeatureRepositoryInterface;
use App\Repository\roomGallery\roomGalleryRepositoryInterface;
use App\Http\Requests\roomGallery\roomGalleryUpdateRequest;
use App\Models\RoomGallery;

class RoomController extends Controller
{
    private $RoomRepository;
    private $BedRepository;
    private $AmenityRepository;
    private $ViewRepository;
    private $FeatureRepository;
    private $roomGalleryRepository;
    public function __construct(
            BedRepositoryInterface $BedRepository,
            AmenityRepositoryInterface $AmenityRepository,
            ViewRepositoryInterface $ViewRepository,
            FeatureRepositoryInterface $FeatureRepository,
            RoomRepositoryInterface $RoomRepository,
            roomGalleryRepositoryInterface $roomGalleryRepository,
            
        ){
            $this->BedRepository = $BedRepository;
            $this->ViewRepository = $ViewRepository;
            $this->AmenityRepository = $AmenityRepository;
            $this->FeatureRepository = $FeatureRepository;
            $this->RoomRepository = $RoomRepository;
            $this->roomGalleryRepository = $roomGalleryRepository;
            DB::connection()->enableQueryLog();
    }
    public function RoomListing(){
        try{
            $room_data = $this->RoomRepository->getRoomListing();
            $logs = "Room screen Listing::";
            Utility::saveDebugLog($logs);
            return view('backend.Room.Listing',compact(['room_data']));
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
                return redirect('admin-backend/room/room-gallery/'.$insertRoomId)->with('success','Create Data successful.');
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
    public function galleryForm($id){
        $roomGalleries = $this->roomGalleryRepository->getRoomGalleryById($id);
        return view('backend.Room.roomGallery',compact(['roomGalleries','id']));
    }
    public function editGallery($id) {
        $find_id = RoomGallery::find($id);
        if(!isset($find_id)){
            abort(404);
        }
        $gallery = $this->roomGalleryRepository->editGallery($id);
        return view('backend.Room.roomGallery', compact(['gallery']));
    }
    public function galleryCreate(roomGalleryRequest $request){
        try{
            $result = $this->roomGalleryRepository->createRoomGallery($request->all());
            $logs   = "Room Room Gallery Create::";
            Utility::saveDebugLog($logs);
            if($result['softGuideStatusCode'] == ReturnMessage::OK ){
                return back()->with('success','Update Data successful.');
            } else {
                return back()->with('error','Update Data successful.');
            }
        } catch(\Exception $e) {
            $logs = "Room Gallery::";
            $logs = $e->getMessage();
            Utility::saveErrorLog($logs);
            abort(500);
        }
    }
    public function updateGallery(roomGalleryUpdateRequest $request){
        if($request->file == null){
            return redirect('admin-backend/room/room-gallery/'.$request->room_id)->with('success','Update Data successful.');
        } else {
            try{
                $result = $this->roomGalleryRepository->updateGallery($request->all());
                $logs   = "Room Gallery sreen Update::";
                Utility::saveDebugLog($logs);
                if($result['softGuideStatusCode'] == ReturnMessage::OK ){
                    return redirect('admin-backend/room/room-gallery/'.$request->room_id)->with('success','Update Data successful.');
                } else {
                    return redirect('admin-backend/room/room-gallery/'.$request->room_id)->with('success','Update Data successful.');
                }
            } catch(\Exception $e) {
                $logs = "Room Gallery sreen Update::";
                $logs = $e->getMessage();
                Utility::saveErrorLog($logs);
                abort(500);
            }
        }
    }
    public function deleteGallery($id){
        try{
            $result = $this->roomGalleryRepository->deleteGallery($id);
            $logs   = "Room Gallery sreen delete::";
            Utility::saveDebugLog($logs);
            if($result['softGuideStatusCode'] == ReturnMessage::OK ){
                return back()->with('success','Delete Data successful.');
            } else {
                return back()->with('error','Update Data successful.');

            }
        } catch(\Exception $e) {
            $logs = "Room sreen delete::";
            $logs = $e->getMessage();
            Utility::saveErrorLog($logs);
            abort(500);
        }
    }

    public function RoomEdit($id){
        $editData        = $this->RoomRepository->RoomEdit($id);
        $roomBed         = $this->BedRepository->getBed();
        $roomView        = $this->ViewRepository->getView();
        $roomAmenity     = $this->AmenityRepository->getAmenity();
        $roomFeature     = $this->FeatureRepository->getFeature();
        $featureByRoomId = $this->FeatureRepository->getFeatureByroomId($id);
        $amenityByroomId = $this->AmenityRepository->getAmenityByroomId($id);
        if($editData == null) {
            abort(404);
        }
        return view('backend.Room.Form',compact(['editData','roomBed','roomView','roomAmenity','roomFeature','amenityByroomId','featureByRoomId']));  
    }
    public function RoomUpdate(RoomUpdateRequest $request){
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
    public function RoomDetail($id) {
        $editData        = $this->RoomRepository->RoomEdit($id);
        $roomBed         = $this->BedRepository->getBed();
        $roomView        = $this->ViewRepository->getView();
        $roomAmenity     = $this->AmenityRepository->getAmenity();
        $roomFeature     = $this->FeatureRepository->getFeature();
        $featureByRoomId = $this->FeatureRepository->getFeatureByroomId($id);
        $amenityByroomId = $this->AmenityRepository->getAmenityByroomId($id);
        if($editData == null) {
            abort(404);
        }
        return view('backend.Room.Detail',compact(['editData','roomBed','roomView','roomAmenity','roomFeature','amenityByroomId','featureByRoomId']));  
    }
   
   
}
