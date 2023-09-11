<?php

namespace App\Http\Controllers\SpecialFeature;
use App\Repository\Feature\FeatureRepositoryInterface;
use App\Repository\Feature\FeatureRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ReturnMessage;
use App\Http\Requests\Feature\FeatureRequest;
use App\Models\SpecialFeature;

class SpecialFeatureController extends Controller
{
    private $FeatureRepository;
    public function __construct(FeatureRepositoryInterface $FeatureRepository){
        $this->FeatureRepository = $FeatureRepository;

    }
    public function FeatureForm(){
        return view('backend.SpecialFeature.Form');
    }
    public function FeatureCreate(FeatureRequest $request){
        try{
            $result     = $this->FeatureRepository->FeatureCreate($request->all());
            if($result['softGuideStatusCode'] == ReturnMessage::OK){
                return redirect()->route('FeatureListing')->with('success','Create Data successful.');
            } else {
                return redirect()->route('FeatureListing')->with('error','Something wrong.');

            }
        } catch(\Exception $e) {
            abort(500);
        }
        
    }
    public function FeatureListing(Request $request){
        try{
            $feature_data = $this->FeatureRepository->getFeature();
            return view('backend.SpecialFeature.Listing',compact(['feature_data']));
        } catch(\Exception $e){
            abort(500);
        }
    }

    public function FeatureEdit($id){
    
        $Feature_data = $this->FeatureRepository->FeatureEdit($id);
        return view('backend.SpecialFeature.Form',compact(['Feature_data']));
        
    }
    public function FeatureDelete($id){
        $date = date('Y-m-d H:i:s');
        $paraObj   = SpecialFeature::find($id);
        $paraObj->deleted_at = $date;
        $paraObj->deleted_by = $id;
        $paraObj->save();
        return redirect()->route('FeatureListing')->with('success','Deleted Data successful.');
    }

    public function FeatureUpdate(FeatureRequest $request){
        try{
            $result     = $this->FeatureRepository->FeatureUpdate($request->all());
            if($result['softGuideStatusCode'] == ReturnMessage::OK){
                return redirect()->route('FeatureListing')->with('success','Update Data successful.');

            } else {
                return redirect()->route('FeatureListing')->with('error','Update Data successful.');
            }

        } catch(\Exception $e){
            abort(500);

        }
        
    }
}
