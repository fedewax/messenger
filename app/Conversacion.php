<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
