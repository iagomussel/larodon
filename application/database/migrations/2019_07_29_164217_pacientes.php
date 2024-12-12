<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pacientes');
        Schema::dropIfExists('pacientes_enderecos');
        Schema::dropIfExists('pacientes_telefones');
        Schema::dropIfExists('pacientes_obs');

        Schema::create('pacientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ficha')->nullable();
            $table->string('nome', 255)->nullable();
            $table->date('data_nasc')->nullable();
            $table->enum('sexo', ['M', 'F'])->nullable();
            $table->string('email')->nullable();
            $table->longText('imagem', 1024 * 1024)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pacientes_enderecos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('paciente_id');
            $table->string('logradouro', 500)->nullable();
            $table->string('numero', 50)->nullable();
            $table->string('complemento', 100)->nullable();
            $table->string('bairro', 100)->nullable();
            $table->string('cidade', 100)->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('cep', 20)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pacientes_telefones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('paciente_id');
            $table->string('telefone', 30)->nullable();
            $table->string('tipo', 50)->nullable();
            $table->string('contato', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('pacientes_obs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('paciente_id');
            $table->string('obs', 1024)->nullable();
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
        Schema::drop('pacientes');
        Schema::drop('pacientes_telefones');
        Schema::drop('pacientes_enderecos');
        Schema::drop('pacientes_obs');
    }
}
