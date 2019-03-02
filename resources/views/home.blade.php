@extends('layouts.app')

@section('content')
<messenger-componente :user_id="{{ auth()->id() }}"></messenger-componente>
@endsection
