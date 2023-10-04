<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Repository\Setting\SettingRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Utility;
use App\ReturnMessage;

class SettingController extends Controller
{
    private $SettingRepository;
    public function __construct(
        SettingRepositoryInterface $SettingRepository, 
    ){
        $this->SettingRepository = $SettingRepository;
        DB::connection()->enableQueryLog();
}
    
    public function SettingEdit(){
        $editData    = $this->SettingRepository->SettingEdit();
        if($editData == null) {
            abort(404);
        }
        return view('backend.Setting.setting',compact(['editData']));  
    }
    public function SettingUpdate(SettingRequest $request){
        // dd($request->all());
        try{
            $result = $this->SettingRepository->update($request->all());
            $logs   = "Setting sreen Update::";
            Utility::saveDebugLog($logs);
            if($result['softGuideStatusCode'] == ReturnMessage::OK ){
                return back()->with('success','Update Data successful.');
            } else {
                return back()->with('error','Update Data successful.');
            }
        } catch(\Exception $e) {
            $logs = "Setting sreen Update::";
            $logs = $e->getMessage();
            Utility::saveErrorLog($logs);
            abort(500);
        }
    }
}
