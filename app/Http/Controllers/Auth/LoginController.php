<?php

namespace App\Http\Controllers\Auth;
use App\Http\Requests\Request;
use App\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $guard = 'Admin';
    protected $redirectAfterlogout = '/login';
    public function getLogin(){
        if(Auth::guard('Admin')->check()){
            return redirect()->route('index');
        } else{
            return view('backend.login.index');
        }
        
    }
    
    public function postlogin(LoginRequest $request){
        $validation = Auth::guard('Admin')->attempt([
            'name'     => $request->get('name'),
            'password' => $request->get('password')
        ]);
        if($validation){
            return redirect()->route('index')->with('success', 'Login successful.');
        } else {
            return redirect()->route('login')
            ->withErrors('error', 'An error occurred. Please check your user name or password and try again.')
            ->withInput();
        }
    }
    public function getLogout(){
        Auth::logout();
        Session::flush();
        return redirect('admin-backend/login');
    }
}
