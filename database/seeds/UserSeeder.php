<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert(
            [
                'name' => 'Administrador',
                'email' => 'admin@umsa.net',
                'password' => bcrypt('123456789'),
            ]
        );
    }
}
