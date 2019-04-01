<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mensaje;
use App\Conversacion;


class MensajeController extends Controller
{
    public function index (Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $id = auth()->id();
        $id_cont = $request->contacto_id;
        
        return $respuesta = Mensaje::listarMensajes($id,$id_cont);
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $array = array('contacto_id' =>  $request->id,
                       'mensaje' =>  $request->mensaje);
        
        Conversacion::actUiltimoMensaje($array);
        $mensaje = Mensaje::registrarMensaje($array);

        return $mensaje;
    }
}
