<?php

use Illuminate\Database\Seeder;
use App\Models\GrupoChamado;


class GrupoChamadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GrupoChamado::create([
           'descricao' => 'TI'
        	]);
    }
}
