<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users',
            function (Blueprint $table) {
              $table->integer('id')->autoIncrement();
              $table->string('name');
              $table->string('email')->unique();
              $table->string('password');
              $table->index(['email']);
              $table->string('perfil', 10)
              ->default('Comum');

              $table->integer('unidade_id');
              $table->foreign('unidade_id')
              ->on('unidades')
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
        Schema::dropIfExists('users');
    }
}
