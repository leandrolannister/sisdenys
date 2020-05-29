<?php

use Illuminate\Database\Seeder;
use App\User;

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
        	'name' => 'Leandro',
        	'email' => 'leandrohendrix@gmail.com',
        	'password' => Hash::make('123'),
        	'equipamento_id' => 1	
        ]);

        User::create([
            'name' => 'super',
            'email' => 'super@gmail.com',
            'password' => Hash::make('123'),
            'equipamento_id' => 1   
        ]);
    }
}
