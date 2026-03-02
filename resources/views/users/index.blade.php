@extends('layouts.app')
@section('title', 'Listagem de usuários')

@section('content')

    <img width="300" src="{{ Vite::asset('resources/images/1.png') }}" alt="">
    <h1 class="title">{{ $greting }}</h1>

        @foreach ($users as $user)
            <div class="user-name">{{ $user->name }} - ({{ $user->email }})</div>
        @endforeach
@endsection


