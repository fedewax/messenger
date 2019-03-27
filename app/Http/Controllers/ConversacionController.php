<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversacion;

class ConversacionController extends Controller
{
    public function index()
    {
        return $respuesta = Conversacion::listarConversaciones();
    }

    public function cambiarEstadoOnline(Request $request)
    {   
              
        $array = array('id'=>$request->id,
                       'online'=>$request->online);
        
        $res = Conversacion::cambiarEstadoOnlineModel($array);
    }
}