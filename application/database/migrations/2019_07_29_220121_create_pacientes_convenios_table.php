<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesConveniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes_convenios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('paciente_id');
            $table->bigInteger('convenio_id');
            $table->string('CodigoAssociado',100)->nullable();
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
        Schema::dropIfExists('pacientes_convenios');
    }
}
