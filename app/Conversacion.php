<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversacion extends Model
{
    protected $table = 'conversaciones';

    public static function listarConversaciones()
    {
        return self::Where('usuario_id', auth()->id())->get();
    }
}
