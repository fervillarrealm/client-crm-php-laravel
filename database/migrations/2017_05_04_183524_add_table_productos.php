<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('cod');
            $table->string('nombre');
            $table->string('nombre_corto');
            $table->integer('catprod_id')->unsigned();
            $table->integer('catprod_sub_id')->unsigned();
            $table->integer('afecta_inv')->unsigned();
            $table->double('exist_min');
            $table->double('exist_max');
            $table->double('exist_porllegar');
            $table->double('exist_comprometida');
            $table->double('exist_disponible');
            $table->double('imp_porc')->unsigned();
            $table->double('costo_ultimo');
            $table->double('costo_promedio');
            $table->double('precio_1');
            $table->double('precio_2');
            $table->double('precio_3');
            $table->text('imagen');
            $table->text('comentario');
            $table->timestamps();

            $table->foreign('catprod_id')->references('id')->on('catprod');
            $table->foreign('catprod_sub_id')->references('id')->on('catprod_sub');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
