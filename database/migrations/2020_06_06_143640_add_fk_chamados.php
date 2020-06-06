<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkChamados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chamados', function($table){
           $table->integer('tipochamado_id')
           ->references('id')
           ->on('tipochamados');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('chamados', function(Blueprint $table){
         $table->dropColumn('tipochamado_id');
      });
    }
}
