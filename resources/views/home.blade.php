@extends('layouts.app')

@section('content')


<messenger-componente v-if="menu == 0" 

    :user_id="{{ auth()->id() }}">

</messenger-componente>

<config-perfil-componente v-if="menu == 1" 

    :user_id="{{ auth()->id() }}">

</config-perfil-componente> 

@endsection
