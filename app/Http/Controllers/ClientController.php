<?php

namespace CsCloud\Http\Controllers;

use Illuminate\Http\Request;

use CsCloud\Http\Requests;

class ClientController extends Controller
{
    public function index(){
        $page_title = 'Clientes';
        
        return view('pages.clientes.index', [
            'page_title'    => $page_title
        ]);
    }
}
