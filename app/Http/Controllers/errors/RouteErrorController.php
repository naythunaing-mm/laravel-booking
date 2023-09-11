<?php

namespace App\Http\Controllers\errors;

use App\Http\Controllers\Controller;

class RouteErrorController extends Controller
{
    public function RouteError(){
        abort(404);
    }

}
