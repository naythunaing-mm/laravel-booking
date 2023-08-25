<?php

namespace App\Http\Controllers;

use App\Models\HotelSetting;
use Illuminate\Http\Request;
class CustomerController extends Controller
{
    public function studenttable(){
        $title         = "The following data are output form database";
        $hotel_setting = HotelSetting::SELECT("name","email","address","online_phone","outline_phone")
                         ->WHERENULL("deleted_at")
                         ->first();
        
        $studentlist = [
            'name' => 'Aung Aung',
            'Age'  => '23',
            'Gender' => 'Female'
        ];
        return view('test.studentlist',compact(['studentlist','hotel_setting','title']));
    }
}
