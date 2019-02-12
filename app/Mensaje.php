<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class Mensaje extends Model
{
    protected $casts = [ 
        'escrito_por_mi' => 'boolean'
    ];
    public static function listarMensajes($id)
    {
        return self::select('id',
            'emisor_id',
            'created_at',
            'contenido',
            DB::raw("IF(emisor_id=$id, 1, 0) AS escrito_por_mi")
            )->get();
    }
    public static function registrarMensaje($array)
    {
        $obj = new Mensaje();
        $obj->emisor_id = auth()->id();
        $obj->receptor_id = $array["id"];
        $obj->contenido = $array["mensaje"];
        $obj->save();
    }
}
