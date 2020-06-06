<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Tipousuario;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'super',
            'email' => 'super@gmail.com',
            'password' => Hash::make('123'),
            'Unidade_id' => 1,
            'grupochamado_id' => 1
        ]);

        Tipousuario::create([
          'descricao' => 'Tecnico',
          'user_id' => 1
        ]);
    }
}
