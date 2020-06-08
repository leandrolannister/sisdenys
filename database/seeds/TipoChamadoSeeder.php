<?php

use Illuminate\Database\Seeder;
use App\Models\Tipochamado;

class TipoChamadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipochamado::create([
          'descricao' => 'Manutenção Predial'          
        ]);

        Tipochamado::create([
          'descricao' => 'Papelaria'          
        ]);
    }
}
