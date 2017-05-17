<?php

use Illuminate\Database\Seeder;

class TipoClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipocli')->insert([
            'nombre'            => 'CLIENTE FINAL',
            'nombre_corto'      => 'CLF'
        ]);
        
        DB::table('tipocli')->insert([
            'nombre'            => 'DISTRIBUIDOR',
            'nombre_corto'      => 'DIST'
        ]);
    }
}
