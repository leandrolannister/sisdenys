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
            $table->enum('descricao',
            ['Admin', 'Tecnico', 'Comum'])->unique();
            $table->index(['descricao']);            

            $table->integer('user_id');
            $table->foreign('user_id')
            ->on('users')
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
