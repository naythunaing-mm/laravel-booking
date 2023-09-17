<?php
// namespace App;
use App\Models\HotelSetting;

if (! function_exists('getsiteconfig')) {
    function getsiteconfig() {
        $site_config = HotelSetting::first();
        return $site_config;    
    }
}
if(!function_exists('getRoomByView')) {
    function getRoomByView($view) {
        $room_name = "";
        if($view->getRoomByView() != null) {
            foreach($view->getRoomByView as $room) {
                $room_name .= $room->name . ",";
            }
        }
        return rtrim($room_name,',');
    }
}
if(!function_exists('getRoomByBed')){
    function getRoomByBed($bed){
        $room_name = "";
        if($bed->getRoomByBed() != null) {
            foreach($bed->getRoomByBed as $room) {
                $room_name .= $room->name . ",";
            }
        }
        return rtrim($room_name,',');
    }
}
