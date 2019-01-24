@extends('layouts.app')

@section('content')
<b-container fluid style="height: 83%">
   <b-row>
        <b-col cols="4">    
           <lista-contactos-componente>
           </lista-contactos-componente>
        </b-col>       

        <b-col cols="8">
           <conversacion-componente>
           </conversacion-componente>
        </b-col>
   </b-row>
</b-container>
@endsection
