<?php
// namespace App;
use App\Models\HotelSetting;

if (! function_exists('getsiteconfig')) {
    function getsiteconfig() {
        $site_config = HotelSetting::first();
        return $site_config;    
    }
}
