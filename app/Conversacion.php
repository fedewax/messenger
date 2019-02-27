<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Conversacion extends Model
{
    protected $table = 'conversaciones';

    protected $filelable = [
        'id','usuario_id','contacto_id','ultimo_mensaje','tiempo_mensaje','notificacion','bloqueado',
        'users.id','users.name as nombre_contacto',
        'conversaciones.id','conversaciones.usuario_id','conversaciones.contacto_id','conversaciones.ultimo_mensaje',
        'conversaciones.notificacion','conversaciones.bloqueado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function listarConversaciones()
    {
        return self::join('users','users.id','=','conversaciones.contacto_id')
        ->select('conversaciones.id','usuario_id','contacto_id','ultimo_mensaje','tiempo_mensaje','notificacion','bloqueado',
        'users.id','users.name as nombre_contacto',
        'conversaciones.id','conversaciones.usuario_id','conversaciones.contacto_id','conversaciones.ultimo_mensaje',
        'conversaciones.notificacion','conversaciones.bloqueado')
        ->Where('usuario_id', auth()->id())->get();
    }

    public static function actUiltimoMensaje($mensaje)
    {
        $date = Carbon::now()->toDateTimeString();
        $emisor_id = auth()->id();

        $obj = Conversacion::where('usuario_id', $emisor_id)
                           ->where('contacto_id', 2)->first();

        $obj->ultimo_mensaje = $mensaje;
        $obj->tiempo_mensaje = $date;
        $obj->save();                   
        
    }
}
