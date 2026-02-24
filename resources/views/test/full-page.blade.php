@extends('layouts.app')

@section('title', 'Página completa')

@section('styles')
    <style>
        body{
            background-color: gray;
        }
        .destaque {
            color: white;
            font-size: 24px;
            border: 2px solid white;
            padding: 10px;
        }
    </style>
@endsection

@section('content')
    <h1>Página completa</h1>
    <p class="destaque">Está página usa 3 @yields!</p>
        <ul>
            <li>Mudou o título da aba do navegador</li>
            <li>Adicionou css customizado</li>
            <li>Criou o conteúdo proncipal</li>
        </ul>
@endsection
