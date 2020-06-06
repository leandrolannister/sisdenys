<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', 
            function (Blueprint $table) {
             
             $table->integer('id')->autoIncrement();
             $table->string('nome', 50);
             $table->string('logradouro', 70);
             $table->string('numero', 10);
             $table->string('bairro', 50);
             $table->string('cep',9);
             $table->string('complemento', 50)->nullable();
             $table->index(['nome']);

             $table->integer('instituicao_id');
             $table->foreign('instituicao_id')
             ->on('instituicoes')
             ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidades');
    }
}
