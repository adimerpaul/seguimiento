<?php

use Illuminate\Database\Seeder;
use App\Seguimiento;

class SeguimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Seguimiento::class,50)->create();
    }
}
