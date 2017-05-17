<?php

namespace CsCloud;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';
     
     public function tipocliente(){
        return $this->hasOne('App\TipoCliente');
     }
}
