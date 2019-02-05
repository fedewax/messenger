<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversacion;

class ConversacionController extends Controller
{
    public function index()
    {
        $respuesta = Conversacion::listarConversaciones();
        //dd($respuesta);
    }
}
