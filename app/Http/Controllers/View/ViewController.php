<?php

namespace App\Http\Controllers\View;
use App\Models\View;
use App\ReturnMessage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\View\ViewRequest;
use App\Repository\View\ViewRepositoryInterface;
use App\Utility;
use Illuminate\Support\Facades\Log;

class ViewController extends Controller
{
    private $viewRepository;
    public function __construct(ViewRepositoryInterface $viewRepository){
        $this->viewRepository = $viewRepository;
        DB::connection()->enableQueryLog();
    }
    public function viewListing(){
        try{
            $view_data = $this->viewRepository->getView();
            $logs = "View screen Listing::";
            Utility::saveDebugLog($logs);
            return view('backend.view.listing',compact(['view_data']));
        } catch(\Exception $e){
            $logs = "View screen Listing::";
            $logs = $e->getMessage();
            Utility::saveErrorLog($logs);
            abort(500);
        }
        
    }
    public function form(){
        try {
            return view('backend.view.form');
        } catch (\Exception $e) {
            $logs = "View sreen create::";
            $logs = $e->getMessage();
            Utility::saveErrorLog($logs);
            abort(500);
        }
    }
    public function create(ViewRequest $request){
        
        try{
            $result = $this->viewRepository->create($request->all());
            $logs = "View sreen create::";
            Utility::saveDebugLog($logs);
            if($result['softGuideStatusCode'] == ReturnMessage::OK){
                return redirect()->route('viewListing')->with('success','Create Data successful.');
            } else {
                return redirect()->route('viewListing')->with('error','Something wrong.');

            }
        } catch(\Exception $e) {
            $logs = "View sreen create::";
            $logs = $e->getMessage();
            Utility::saveErrorLog($logs);
            abort(500);
        }
    }

   
    public function viewEdit($id){
        try {
            $view_data = $this->viewRepository->viewEdit($id);
            $logs = "View sreen Update::";
            Utility::saveDebugLog($logs);
            return view('backend.view.form',compact(['view_data']));
        } catch (\Exception $e) {
            $logs = "View sreen Update::";
            $logs = $e->getMessage();
            Utility::saveErrorLog($logs);
            abort(500);
        }
        
        
    }
    public function viewUpdate(ViewRequest $request){
        try{
            $result     = $this->viewRepository->update($request->all());
            $logs = "View sreen Update::";
            Utility::saveDebugLog($logs);
            if($result['softGuideStatusCode'] == ReturnMessage::OK ){
                return redirect()->route('viewListing')->with('success','Update Data successful.');
            } else {
                return redirect()->route('viewListing')->with('error','Update Data successful.');

            }
        } catch(\Exception $e) {
            $logs = "View sreen Update::";
            $logs = $e->getMessage();
            Utility::saveErrorLog($logs);
            abort(500);
        }
    }
    public function viewdelete($id){
        try{
            $result     = $this->viewRepository->delete($id);
            $logs = "View sreen delete::";
            Utility::saveDebugLog($logs);
            if($result['softGuideStatusCode'] == ReturnMessage::OK ){
                return redirect()->route('viewListing')->with('success','Delete Data successful.');
            } else {
                return redirect()->route('viewListing')->with('error','Update Data successful.');

            }
        } catch(\Exception $e) {
            $logs = "View sreen delete::";
            $logs = $e->getMessage();
            Utility::saveErrorLog($logs);
            abort(500);
        }
    }

}
