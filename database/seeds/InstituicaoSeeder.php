<?php

use Illuminate\Database\Seeder;
use App\Models\Instituicao;

class InstituicaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Instituicao::create([
          'nome' => 'PrefeituraSP',
          'sigla' => 'PSP'
        ]);
    }
}
