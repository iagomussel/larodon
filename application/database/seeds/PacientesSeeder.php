<?php

use App\Pacientes;
use Illuminate\Database\Seeder;

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
        $pacientes = factory(Pacientes::class, 1000)->create();
    }
}
