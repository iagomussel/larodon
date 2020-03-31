<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dentistas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

		Schema::dropIfExists('dentistas');
		Schema::dropIfExists('pacientes_dentistas');
		Schema::create("dentistas",function(Blueprint $table){
			$table->bigIncrements('id');			
            $table->string('nome',255);
            $table->string('especializacao',255)->nullable();
            $table->bigInteger('id_usuario');			
            $table->string('imagem',500)->nullable();
			$table->timestamps();
			$table->softDeletes();
			
        });

        Schema::create("pacientes_dentistas",function(Blueprint $table){
			$table->bigIncrements('id');	
			$table->bigInteger('paciente_id');	
            $table->bigInteger('dentista_id');	
            $table->timestamps();
			$table->softDeletes();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
			Schema::dropIfExists("dentistas");
			Schema::dropIfExists("pacientes_dentistas");
    }
}
