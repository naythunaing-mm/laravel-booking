<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
   public function testing(){
    $test ='Hello';
    $array = [
        'name' => 'Nay Thu Naing',
        'age'  => '30',
        'address' => 'Yangon'
    ];
    return view('test.test',compact(['array'],'test'));
   }

//    public function requesting(Request $requesting){
//     dd($requesting->all());
//    }
//    public function getid($getid){
//     dd($getid);
//    }
    public function view_create(){
        return view('test.view_create');
    }

    public function view_created(Request $request){
        $view_name = $request->get('name');
        $date      = date('Y-m-d H:i:s');
        $user_id   = '1';
        DB::table('view')->insert([
            'name'       => $view_name,
            'created_by' => $user_id,
            'updated_by' => $user_id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }
}
