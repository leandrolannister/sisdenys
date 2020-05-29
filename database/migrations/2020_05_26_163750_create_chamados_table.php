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
            $table->string('titulo', 50);
            $table->string('tipo', 10);
            $table->string('descricao');
            $table->enum('status', 
                ['Aberto', 'Pendente_usuario',
                 'Pendente_tecnico', 'Fechado',
                 'Reaberto'])
                ->default('Aberto');
            
            $table->date('data');
                        
            $table->integer('user_id');
            $table->foreign('user_id')
            ->on('users')
            ->references('id');

            $table->integer('grupochamado_id');
            $table->foreign('grupochamado_id')
            ->on('grupochamados')
            ->references('id');

            $table->index(['data']);            
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
