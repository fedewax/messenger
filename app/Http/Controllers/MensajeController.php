<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mensaje;
use DB;

class MensajeController extends Controller
{
    public function index ()
    {
        $id = auth()->id();
        
        return Mensaje::select(
            'id',
            'emisor_id',
            'created_at',
            'contenido',
            DB::raw("IF(emisor_id=$id, 1, 0) AS escrito_por_mi")
            )->get();
    }
}
