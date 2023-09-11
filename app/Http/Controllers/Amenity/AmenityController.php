<?php

namespace App\Http\Controllers\Amenity;
use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;
use App\Http\Requests\Amenity\AmenityRequest;
use App\Repository\Amenity\AmenityRepositoryInterface;
use App\ReturnMessage;
class AmenityController extends Controller
{
    private $AmenityRepository;
    public function __construct(AmenityRepositoryInterface $AmenityRepository){
        $this->AmenityRepository = $AmenityRepository;

    }
    public function AmenityForm(){
        $amenity_type = ["General","Bathroom","Others"];
        return view('backend.Amenity.AmenityForm',compact(['amenity_type']));
    }
    public function AmenityCreate(AmenityRequest $request){
        try{
            $result     = $this->AmenityRepository->AmenityCreate($request->all());
            if($result['softGuideStatusCode'] == ReturnMessage::OK){
                return redirect()->route('AmenityListing')->with('success','Create Data successful.');
            } else {
                return redirect()->route('AmenityListing')->with('error','Something wrong.');

            }
        } catch(\Exception $e) {
            abort(500);
        }
        
    }
    public function AmenityListing(Request $request){
        try{
            $amenity_data = $this->AmenityRepository->getAmenity();
            return view('backend.Amenity.Amenitylisting',compact(['amenity_data']));
        } catch(\Exception $e){
            abort(500);
        }
    }

    public function AmenityEdit($id){
        
        
        $amenity_type = ["General","Bathroom","Others"];
        $amenity_data = $this->AmenityRepository->AmenityEdit($id);
        return view('backend.Amenity.AmenityForm',compact(['amenity_data','amenity_type']));
        
    }
    public function AmenityDelete($id){
        $date = date('Y-m-d H:i:s');
        $paraObj   = Amenity::find($id);
        $paraObj->deleted_at = $date;
        $paraObj->deleted_by = $id;
        $paraObj->save();
        return redirect()->route('AmenityListing')->with('success','Deleted Data successful.');
    }

    public function AmenityUpdate(AmenityRequest $request){
        try{
            $result     = $this->AmenityRepository->AmenityUpdate($request->all());
            if($result['softGuideStatusCode'] == ReturnMessage::OK){
                return redirect()->route('AmenityListing')->with('success','Update Data successful.');

            } else {
                return redirect()->route('AmenityListing')->with('error','Update Data successful.');
            }

        } catch(\Exception $e){
            abort(500);

        }
        
    }
}
