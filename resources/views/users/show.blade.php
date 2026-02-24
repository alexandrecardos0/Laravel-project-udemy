@extends('layouts.app')
@section('title', 'Mostrando usuário' . $user->name)

@section('content')
    <h1>Mostrar usuário {{ $user->name }}</h1>

        @if ($user->id === 1)
            <div>Sou admin</div>
        @else
            <div>Não sou admin</div>
        @endif
@endsection


