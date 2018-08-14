<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::firstOrCreate([
            'email'=> 'bram.klapwijk00@outlook.com',
            'name' => 'Bram Klapwijk',
            'password'=> bcrypt('pass1234x')
        ]);
    }
}
