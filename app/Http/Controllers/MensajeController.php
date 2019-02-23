<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mensaje;

class MensajeController extends Controller
{
    public function index (Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $id = auth()->id();
        $id_cont = 2;
        return $respuesta = Mensaje::listarMensajes($id,$id_cont);
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $mensaje = $request->mensaje;
        $id = $request->id;
        $array = array('id' =>  $id,
                       'mensaje' =>  $mensaje);
        $respuesta = Mensaje::registrarMensaje($array);
    }
}
