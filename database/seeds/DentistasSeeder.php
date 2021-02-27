<?php

use Illuminate\Database\Seeder;

class DentistasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Dentistas::class,4)->create();

    }
}
