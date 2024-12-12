<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('consultas');
        Schema::create('consultas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('dentista_id');
            $table->dateTime('horario');
            $table->dateTime('horario_termino')->nullable();
            $table->string('obsercacao', 500)->nullable();
            $table->bigInteger('paciente_id')->nullable();
            $table->bigInteger('procedimento_id')->nullable();
            $table->string('paciente_nome', 25)->nullable();
            $table->string('paciente_telefone', 25)->nullable();
            $table->string('status', 25)->nullable();
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
        Schema::dropIfExists('consultas');
    }
}
