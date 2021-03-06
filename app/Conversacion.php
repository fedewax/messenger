<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Conversacion extends Model
{
    protected $table = 'conversaciones';

    protected $filelable = [
        'id','usuario_id','contacto_id','ultimo_mensaje','tiempo_mensaje','notificacion','bloqueado', 'user_ultimo_mensaje','online',
        'users.id','users.name as nombre_contacto','users.imagen',
        'conversaciones.id','conversaciones.usuario_id','conversaciones.contacto_id','conversaciones.ultimo_mensaje',
        'conversaciones.notificacion','conversaciones.bloqueado','conversaciones.user_ultimo_mensaje','conversaciones.online'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function listarConversaciones()
    {
        return self::join('users','users.id','=','conversaciones.contacto_id')
        ->select('conversaciones.id','usuario_id','contacto_id','ultimo_mensaje','tiempo_mensaje','notificacion','bloqueado','user_ultimo_mensaje','online',
        'users.id','users.name as nombre_contacto','users.imagen',
        'conversaciones.id','conversaciones.usuario_id','conversaciones.contacto_id','conversaciones.ultimo_mensaje',
        'conversaciones.notificacion','conversaciones.bloqueado','conversaciones.user_ultimo_mensaje','conversaciones.online')
        ->Where('usuario_id', auth()->id())->get();
    }

    //hacer rl iinner join para sacar la imagen

    public static function actUiltimoMensaje($array)
    {
        $date = Carbon::now()->toDateTimeString();
        $emisor_id = auth()->id();
        
        //actulizar conversacion 1
        $obj = Conversacion::where('usuario_id', $emisor_id)
                           ->where('contacto_id', $array["contacto_id"])->first();

        $obj->ultimo_mensaje = $array["mensaje"];
        $obj->tiempo_mensaje = $date;
        $obj->user_ultimo_mensaje = $emisor_id;
        $obj->save();

        //actulizar conversacion 2
        $obj2 = Conversacion::where('usuario_id', $array["contacto_id"])
                            ->where('contacto_id', $emisor_id)->first();

        $obj2->ultimo_mensaje = $array["mensaje"];
        $obj2->tiempo_mensaje = $date;
        $obj2->user_ultimo_mensaje = $emisor_id;
        $obj2->save();
    }

    public static function cambiarEstadoOnlineModel($array)
    {
        Conversacion::where('contacto_id', $array["id"])->update(['online'=> $array["online"]]);
    }
}
