<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{ 
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public static function obtenerDatosUsaurio ($id)
    {
        return self::where('id', $id)->first();
    }

    public static function actualizarUsuarioModel($array)
    {
        $obj = User::find($array["id"]);
        $obj->name = $array["name"];
        $obj->email = $array["email"];
        if(isset($array["imagen"]))
        {
            $obj->imagen = $array["imagen"];
        }
        $obj->save();
    }

    public static function comprobarEmailModel($email)
    {
        return self::select('email')->where('email', $email)->first();
    }

    public static function obtenerImagenUsuario($id)
    {
        return self::select('imagen')->where('id', $id)->first();
    }

    public static function modificarClaveModel($password, $id)
    {
        $obj = User::find($id);
        $obj->password = $password;
        $obj->save();   
    }
}
