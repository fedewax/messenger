<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Image;

class UsuarioController extends Controller
{
    public function datosUsuario(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        return $respuesta = User::obtenerDatosUsaurio($request->id);
    }

    public function actualizarUsuario(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        if($request->imagen)
        {
            $respuesta = User::obtenerImagenUsuario($request->id);
            $nombreImagenAnterior = $respuesta["imagen"];
            
            if($nombreImagenAnterior != '')
            {
            //si existe una imagen con ese nombre en la carpeta la borra con el metodo unlink.
                if(file_exists(public_path('imagenes/').$nombreImagenAnterior))
                    unlink(public_path('imagenes/').$nombreImagenAnterior);
                else
                    dd('El archivo no existe.');
            }
            
            $imagen = $request->imagen;
            //sacar nombre de la imagen
            $nombreImagen =time().'.' . explode('/', explode(':', substr($imagen, 0, strpos($imagen, ';')))[1])[1];
            //guardar en la carpeta y poner nombre al archivo de la imagen
            Image::make($request->imagen)->save(public_path('imagenes/').$nombreImagen);  
            
            $array = array('name'  => $request->name,
            'email' => $request->email,
            'id'    => $request->id,
            'imagen'=> $nombreImagen); 
        }
        else
        {
            $array = array('name'  => $request->name,
            'email' => $request->email,
            'id'    => $request->id); 
        } 
                     
        User::actualizarUsuarioModel($array);
    }

    public function comprobarEmail(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $respuesta = User::comprobarEmailModel($request->email);
        
        if(!$respuesta)
            return response()->json(false);
        else
            return response()->json(true); 
    }
}
