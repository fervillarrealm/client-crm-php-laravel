<?php

namespace CsCloud\Http\Controllers;

use CsCloud\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use CsCloud\Http\Requests;
use JsValidator;
use Debugbar;
use Toastr;
use Input;

class LoginController extends Controller
{
    protected $validationRules=[
                'loginUserName' => 'required|max:255',
                'password' => 'required',
    ];
    
    public function getLogin(){
        
        $validator = JsValidator::make($this->validationRules);
        
        $page_title = 'Iniciar Sesión';
        
        return view('pages.login')->with([
            'validator'     => $validator,
            'page_title'    => $page_title
        ]);
    }
    
     
    public function postLogin(Request $request){
        
        $remember = (Input::has('remember')) ? true : false;
        
        $this->validate($request, [
			'loginUserName' 	=>  'required|alpha',
			'password'	        =>	'required'
		]);
		
		$user = Users::where('name', strtolower(Input::get('loginUserName')))->first();
        if(!$user) {
            Toastr::error($message = 'Usuario inválido', $title = 'Error al Iniciar Sesión', $options = []);
            return redirect()->back();
        }
		
        if (!Auth::attempt([
                'name'      => strtolower(Input::get('loginUserName')),
                'password'  => Input::get('password')
            ], $remember)) {
            Toastr::error($message = 'Combinación errónea de nombre de usuario y contraseña', $title = 'Error al Iniciar Sesión', $options = []);
            return redirect()->back();
        }
        
        return redirect()->route('home');
    }
    
    public function GetLogout(){
        
        Auth::logout();
		return redirect()->route('login');
    }
    
}
