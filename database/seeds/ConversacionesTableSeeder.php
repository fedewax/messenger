<?php

use Illuminate\Database\Seeder;
use App\Conversacion;

class ConversacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Conversacion::create([
            'usuario_id'=>1,
            'contacto_id'=>2,
            'ultimo_mensaje'=>null,
            'tiempo_mensaje'=>null
            //'notificaciones'=>'',
            //'bloqueado' =>''
        ]);
        Conversacion::create([
            'usuario_id'=>2,
            'contacto_id'=>1,
            'ultimo_mensaje'=>null,
            'tiempo_mensaje'=>null
            //'notificaciones'=>'',
            //'bloqueado' =>''
        ]);
    }
}
