<?php

namespace App\Http\Controllers;
use App\Models\View;
use Illuminate\Http\Request;
use App\Http\Requests\viewListingRequest;

class ViewController extends Controller
{
    public function View(){
     
        return view('test.view');
    }
    public function createView(viewListingRequest $request)
    {  
        $view_name = $request->get('name'); // Retrieve 'name' from form input
        $user_id = 1;
        $timestamp = date('Y-m-d H:i:s');

        $paraObj = new View();
        $paraObj->name = $view_name;
        $paraObj->updated_by = $user_id;
        $paraObj->created_by = $user_id;
        $paraObj->created_at = $timestamp;
        $paraObj->updated_at = $timestamp;
        $paraObj->save();

        return redirect()->route('viewListing')->with("message","Data insert Successful");
    }
    
    public function viewEdit($id){
        $view_data = View::find($id);
        return view('test.View',compact(['view_data']));
    }
    public function ViewUpdate(viewListingRequest $request){
        
        $id      = $request->get('id');
        $name    = $request->get('name');
        $paraObj = View::find($id);
        $paraObj->name = $name;
        $paraObj->save();
        return redirect()->route('viewListing')->with('message', 'Data Upate succeful.');
    }
   
    public function viewdelete($id){
   
        $paraObj = View::find($id);
        $date    = date('Y-m-d H:i:s');
        $paraObj->deleted_at = $date;
        $paraObj->save();
        return redirect()->route('viewListing')->with('message', 'Data Upate succeful.');
    }
    public function viewListing(){
        $view_data = View::SELECT("id","name")
                    ->whereNull('deleted_at')
                    ->get();
        return view('test.view_Listing',compact(['view_data']));

    }
}
