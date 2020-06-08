<?php

use Illuminate\Database\Seeder;
use App\Models\Unidade;

class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Unidade::create([
        'nome' => 'SMC-Secretaria Municipal de Cultura',
        'logradouro' => 'Rua 15 de Maior',
        'numero' => '100',
        'bairro' => 'Centro',
        'cep' => '03664-030',
        'instituicao_id' => 1,
      ]);

      Unidade::create([
        'nome' => 'BMA - Biblioteca Mário de Andrade',
        'logradouro' => 'Rua 1 de Abril',
        'numero' => '1',
        'bairro' => 'Centro',
        'cep' => '03456-020',
        'instituicao_id' => 1,
      ]);
    }
}
