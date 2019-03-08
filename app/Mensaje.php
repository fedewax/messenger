<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Events\eventMensajeEnviado;


class Mensaje extends Model
{
    protected $casts = [ 
        'escrito_por_mi' => 'boolean'
    ];
    public static function listarMensajes($id,$id_contac)
    {
        return self::select('id',
             'emisor_id',
             'created_at',
             'contenido',
             DB::raw("IF(emisor_id=$id, 1, 0) AS escrito_por_mi")
             )->where(function ($query) use ($id,$id_contac){
                $query->where('emisor_id',$id)->where('receptor_id',$id_contac)->get();
            })->orWhere(function ($query) use ($id,$id_contac){
                $query->where('emisor_id',$id_contac)->where('receptor_id',$id)->get();
            })->orderBy('id', 'asc')->get();
           
    }
    public static function registrarMensaje($array)
    {
        $mensaje = new Mensaje();
        $mensaje->emisor_id = auth()->id();
        $mensaje->receptor_id = $array["contacto_id"];
        $mensaje->contenido = $array["mensaje"];
        $mensaje->save();  
        event(new eventMensajeEnviado($mensaje));
        return $mensaje; 
    }
}
