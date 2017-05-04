<?php

namespace CsCloud\Http\Controllers;

use Illuminate\Http\Request;

use CsCloud\Http\Requests;
use Debugbar;

class HomeController extends Controller
{
    public function index(){
        
        Debugbar::error('Error!');
        
         $data['tasks'] = [
                [
                        'name' => 'Design New Dashboard',
                        'progress' => '87',
                        'color' => 'danger'
                ],
                [
                        'name' => 'Create Home Page',
                        'progress' => '76',
                        'color' => 'warning'
                ],
                [
                        'name' => 'Some Other Task',
                        'progress' => '32',
                        'color' => 'success'
                ],
                [
                        'name' => 'Start Building Website',
                        'progress' => '56',
                        'color' => 'info'
                ],
                [
                        'name' => 'Develop an Awesome Algorithm',
                        'progress' => '10',
                        'color' => 'success'
                ]
        ];
        
        $page_title = "Inicio";
        $myarray = array_collapse($data);
        
        return view('pages.home', [
                'tasks' => $myarray,
                'page_title' => $page_title
        ]);
    }
}
