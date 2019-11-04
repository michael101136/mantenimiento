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
        DB::table('users')->insert([
            'name' => 'michael',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret'),
            'privilege' => 'administrador',
            'status'=>'A'
        ]);
    }
}
