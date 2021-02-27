<?php

use Illuminate\Database\Seeder;
use App\Pacientes;

class PacientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $pacientes = factory(Pacientes::class,1000)->create();
    }
}
