<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipocli_id')->unsigned();
            $table->string('cod');
            $table->string('identificacion');
            $table->string('nombre');
            $table->text('direccion');
            $table->string('telf1');
            $table->string('telf2');
            $table->string('whatsapp');
            $table->string('skype');
            $table->string('email');
            $table->string('web');
            $table->integer('status')->default(1);
            $table->integer('jubilado')->default(0);
            $table->string('referencia');
            $table->text('img');
            $table->date('fecha_nac');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
