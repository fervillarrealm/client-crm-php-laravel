<?php

namespace CsCloud\Http\Controllers;

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
        Toastr::success($message = 'data', $title = 'info', $options = []);
        
        return view('pages.login')->with([
            'validator' => $validator
        ]);
    }
    
     
    public function postLogin(Request $request){
        Toastr::success($message = 'data', $title = 'After post', $options = []);
        
        $this->validate($request, [
			'loginUserName' 	=>  'required|alpha',
			'password'	        =>	'required'
		]);
		
		Toastr::success($message = 'data', $title = 'Entering post', $options = []);
		
		$pass_enc = $request['password'];
	    $key = "abcdefgh";
		$iv = "hgfedcba";
		$block = mcrypt_get_block_size('des', 'cbc');
		$pad = $block - (strlen($pass_enc) % $block);
		$pass_enc .= str_repeat(chr($pad), $pad);
		$pwd = "0x" . strtoupper(bin2hex(mcrypt_encrypt(MCRYPT_DES, $key, $pass_enc, MCRYPT_MODE_CBC, $iv)));

		 $credentials = [
            'name' 			=> $request['loginUserName'],
            'password'   	=> $request['password']
        ];
        
        /*if (!Auth::attempt($credentials)) {
            return redirect()->back()->with(['fail' => 'Credenciales incorrectas.' . $pwd]);
        }*/
        
        return redirect()->route('home');
    }
    
}
