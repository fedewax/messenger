<?php

use Illuminate\Database\Seeder;
use App\Mensaje;

class MensajesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mensaje::create([
            'emisor_id'=> 1,
            'receptor_id'=> 2,
            'contenido' => 'hola como estas'
        ]);
        Mensaje::create([
            'emisor_id'=> 2,
            'receptor_id'=> 1,
            'contenido' => 'bien gracias y tu'
        ]);
        Mensaje::create([
            'emisor_id'=> 1,
            'receptor_id'=> 3,
            'contenido' => 'hola como estas wey joto'
        ]);
        Mensaje::create([
            'emisor_id'=> 3,
            'receptor_id'=> 1,
            'contenido' => 'bien gracias y tu wey '
        ]);
    }
}
