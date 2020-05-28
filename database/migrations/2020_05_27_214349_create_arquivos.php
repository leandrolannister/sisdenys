<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArquivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('arquivos', 
        function (Blueprint $table) {
          $table->integer('id')->autoIncrement();
          $table->string('path')->unique();
          $table->timestamps();

          $table->integer('chamado_id');
          $table->foreign('chamado_id')
          ->on('chamados')
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
        Schema::dropIfExists('arquivos');
    }
}
