<?php

use Illuminate\Database\Seeder;

class DetalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detalles')->insert([
            'nombre'=>'Oficina ',
            'seguimiento_id'=>1,
            'created_at'=>date("Y-m-d H:i:s")
        ]);
    }
}
