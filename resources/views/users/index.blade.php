@extends('layouts.app')
@section('title', 'Listagem de usuários')

@section('content')
    <h1>{{ $greting }}</h1>

        @foreach ($users as $user)
            <div>{{ $user->name }} - ({{ $user->email }})</div>
        @endforeach
@endsection


