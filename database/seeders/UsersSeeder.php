<?php

namespace Database\Seeders;


use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email'=>'ricardocastromendez@yahoo.es',
            'type'=>'user',
            'password'=>bcrypt('prueba')
        ]);
    }
}
