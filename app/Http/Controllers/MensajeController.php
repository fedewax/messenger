<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mensaje;

class MensajeController extends Controller
{
    public function index ()
    {
        $id = auth()->id();
        return $respuesta = Mensaje::listarMensajes($id);
    }
    public function store(Request $request)
    {
        $mensaje = $request->mensaje;
        $id = $request->id;
        $array = array('id' =>  $id,
                       'mensaje' =>  $mensaje);
        $respuesta = Mensaje::registrarMensaje($array);
   
    }
}
