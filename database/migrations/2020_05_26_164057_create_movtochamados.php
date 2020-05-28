<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovtochamados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('movtochamados', 
        function (Blueprint $table) {
          $table->integer('id')->autoIncrement();
          $table->enum('titulo', 
          ['Normal', 'Status']);
          
          $table->string('tipo', 10);          
          $table->enum('status', 
                ['Aberto', 'Pendente Usuário',
                 'Pendente Técnico', 'Fechado']);
          $table->string('descricao');
          $table->integer('user_id');

          $table->integer('chamado_id');
          $table->foreign('chamado_id')
          ->on('chamados')
          ->references('id');  
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
        Schema::dropIfExists('movtochamados');
    }
}
