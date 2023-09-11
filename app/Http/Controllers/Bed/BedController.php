<?php

namespace App\Http\Controllers\Bed;
use App\Models\Bed;
use App\ReturnMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bed\BedRequest;
use App\Repository\Bed\BedRepositoryInterface;
use App\Utility;

class BedController extends Controller
{
    private $bedRepository;
    public function __construct(BedRepositoryInterface $bedRepository){
        $this->bedRepository = $bedRepository;
        DB::connection()->enableQueryLog();
    }
    public function BedListing(Request $request){
        try{
            $bed_data = $this->bedRepository->getBed();
            $logs = "Bed screen Listing::";
            Utility::saveDebugLog($logs);
            return view('backend.bed.Bedlisting',compact(['bed_data']));
        } catch(\Exception $e) {
            $logs = "Bed screen Listing::";
            $logs = $e->getMessage();
            abort(500);
        }
        
    }
    public function BedForm(){
        return view('backend.Bed.BedForm');
    }

    public function BedCreate(BedRequest $request){
        try{
            $result     = $this->bedRepository->BedCreate($request->all());
            $logs = "Bed screen Create::";
            Utility::saveDebugLog($logs);
            if($result['softGuideStatusCode'] == ReturnMessage::OK){
                return redirect()->route('BedListing')->with('success','Create Data successful.');
            } else {
                return redirect()->route('BedListing')->with('error','Something wrong.');

            }
        } catch(\Exception $e) {
            $logs = "Bed screen Create::";
            $logs = $e->getMessage();
            abort(500);
        }
    }
    public function BedEdit($id){
        $bed_data = $this->bedRepository->bedEdit($id);
        return view('backend.Bed.BedForm',compact(['bed_data']));
    }
    public function BedUpdate(BedRequest $request){
        try{
            $result     = $this->bedRepository->bedUpdate($request->all());
            $logs = "Bed screen Update::";
            Utility::saveDebugLog($logs);
            if($result['softGuideStatusCode'] == ReturnMessage::OK){
                return redirect()->route('BedListing')->with('success','Update Data successful.');

            } else {
                return redirect()->route('BedListing')->with('error','Update Data successful.');
            }

        } catch(\Exception $e){
            $logs = "Bed screen Update::";
            $logs = $e->getMessage();
            abort(500);

        }
        
    }
    public function BedDelete($id){
        $date = date('Y-m-d H:i:s');
        $paraObj   = Bed::find($id);
        $paraObj->deleted_at = $date;
        $paraObj->deleted_by = $id;
        $paraObj->save();
        return redirect()->route('BedListing')->with('success','Deleted Data successful.');
    }
}
