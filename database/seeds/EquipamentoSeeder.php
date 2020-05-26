<?php

use Illuminate\Database\Seeder;
use App\Models\Equipamento;

class EquipamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Equipamento::create([
        'nome' => 'Unidade 1',
        'logradouro' => 'Rua 15 de Maior',
        'numero' => '100',
        'bairro' => 'Centro',
        'cep' => '03664-030',
        'instituicao_id' => 1,		
      ]);    
    }
}
