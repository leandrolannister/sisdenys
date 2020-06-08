<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipousuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipousuarios', 
          function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->enum('tipo',['Admin', 
            'Tecnico']);
            
            $table->index(['tipo']); 

            $table->integer('user_id');
            $table->foreign('user_id')
            ->on('users')
            ->references('id');

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
        Schema::dropIfExists('tipousuarios');
    }
}
