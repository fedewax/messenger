<?php

use Illuminate\Database\Seeder;

use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Juan',
            'email'=>'hola@gmail.com',
            'password'=>bcrypt('123')
        ]);
        User::create([
            'name'=>'Carlos',
            'email'=>'carlos@gmail.com',
            'password'=>bcrypt('123')
        ]);
        User::create([
            'name'=>'Jose',
            'email'=>'jose@gmail.com',
            'password'=>bcrypt('123')
        ]);
    }
}
