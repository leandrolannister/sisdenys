<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkMovtoChamados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('movtochamados', function($table){
        $table->integer('tipochamado_id')
        ->references('id')
        ->on('tipochamados')
        ->after('chamado_id');   
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('movtochamados', function(Blueprint $table){
         $table->dropColumn('tipochamado_id');
      });
      
    }
}
