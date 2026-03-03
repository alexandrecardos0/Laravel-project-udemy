@extends('layouts.app')
@section('title','Detalhes do post')

@section('content')

        <h1 class="post-title">{{ $post->title }}</h1>
        <p class="post-body">{{ $post->body }}</p>
        <p>ID: {{ $post->id }}</p>
        <p>Criado em: {{ $post->created_at->format('d/m/Y H:i') }}</p>

        <a href="{{ route('posts.index') }}" class="btn-link">Voltar para listagem</a>

@endsection
