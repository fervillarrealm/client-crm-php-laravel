<?php

namespace CsCloud\Http\Controllers;

use Illuminate\Http\Request;

use CsCloud\Http\Requests;
use CsCloud\Clientes;
use CsCloud\TipoCliente;
use Illuminate\Support\Facades\Redirect;
use Datatables;
use JsValidator;
use Toastr;
use Input;
use Debugbar;

class ClientController extends Controller
{
    protected $validationRules=[
                'nombre' => 'required|max:255'
        ];
        
    public function index(){
        $page_title = 'Clientes';
        
        return view('pages.clientes.index', [
            'page_title'    => $page_title
        ]);
    }
    
    
    
    public function crear(){
        $page_title = 'Nuevo Cliente';
        $tipocli = TipoCliente::all();
        
        $validator = \JsValidator::make($this->validationRules);
        
        Debugbar::info($validator);
        
        return view('pages.clientes.nuevo', [
            'page_title'    => $page_title,
            'tipocli'       => $tipocli,
            'validator'     => $validator,
        ]);
    }
    
    public function insertCliente(Request $request){
        Debugbar::info(Input::all());
        
        $page_title = 'Nuevo Cliente';
        $tipocli = TipoCliente::all();
        
        $v = \Validator::make($request->all(), $this->validationRules);
        
        if ($v->fails()) {
             foreach($v->messages()->getMessages() as $field_name => $messages) {
                foreach($messages AS $message) {
                    Toastr::error($message, $title = "Error", $options = []);
                }
            }
            return redirect()->back()->withErrors($v->errors());
        }
        
        $cliente = new Clientes;
        $cliente->nombre = Input::get('nombre');
        $cliente->tipocli_id = Input::get('tipocli');
        $cliente->cod = Input::get('cod');
        $cliente->identificacion = Input::get('identificacion');
        $cliente->direccion = Input::get('direccion');
        $cliente->telf1 = Input::get('telf1');
        $cliente->telf2 = Input::get('telf2');
        $cliente->whatsapp = Input::get('whatsapp');
        $cliente->skype = Input::get('skype');
        $cliente->email = Input::get('email');
        $cliente->web = Input::get('web');
        $cliente->status = Input::get('status');
        $cliente->referencia = Input::get('referencia');
        $cliente->fecha_nac = Input::get('fecha_nac');
        $cliente->save();
        
        Toastr::success("Cliente creado correctamente!", $title = "Éxito", $options = []);
        return redirect()->route('clientes');
    }
    
    public function listaClientes(){
        $clientes = Clientes::select(['nombre', 'email', 'telf1', 'direccion', 'status', 'direccion'])->get();
        
        Debugbar::info($clientes);

        return Datatables::of($clientes)->make();
    }
    
}
