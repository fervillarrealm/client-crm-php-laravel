<?php

namespace CsCloud\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use CsCloud\Http\Requests;
use JsValidator;
use Toastr;

class LoginController extends Controller
{
    protected $validationRules=[
                'loginUserName' => 'required|max:255',
                'password' => 'required',
    ];
    
    public function getLogin(){
        
        $validator = JsValidator::make($this->validationRules);
        
        return view('pages.login')->with([
            'validator' => $validator
        ]);
    }
    
     
    public function postLogin(Request $request){
        
        $this->validate($request, [
			'loginUserName' 	=>  'required|alpha',
			'password'	        =>	'required'
		]);
		
		 $credentials = [
            'name' 			=> $request['loginUserName'],
            'password'   	=> $request['password']
        ];
        
        if (!Auth::attempt($credentials)) {
            Toastr::error($message = 'Credenciales incorrectas', $title = 'Error', $options = []);
            return redirect()->back();
        }
        
        return redirect()->route('home');
    }
    
    public function GetLogout(){
        
        Auth::logout();
		return view('pages.login');
    }
    
}
