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
        //if (!$request->ajax()) return redirect('/');
        $mensaje = $request->mensaje;
        $id = $request->id;
        $array = array('contacto_id' =>  $id,
                       'mensaje' =>  $mensaje);
        $respuesta = Mensaje::registrarMensaje($array);
        $respuesta = Conversacion::actUiltimoMensaje($array);

    }
}
