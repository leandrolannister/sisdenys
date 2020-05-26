<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChamadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chamados', 
          function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->enum('titulo', ['Normal', 'Status']);
            $table->string('descricao');
            $table->enum('status', 
                ['Aberto', 'Pendente Usuário',
                 'Pendente Técnico', 'Fechado'])
                ->default('Aberto');
            $table->date('data');
            $table->index(['data']);
            
            $table->integer('user_id');
            $table->foreign('user_id')
            ->on('users')
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
        Schema::dropIfExists('chamados');
    }
}
