@extends('layouts.app')
@section('title','Listagem de posts')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="title">{{ $title }}</h1>
    <a href="{{ route('posts.create') }}" class="btn-link">+ Criar Novo Post</a>

    @if ($posts->count() > 0)
        <ul class="post-list">
            @foreach ($posts as $post)
                <li class="post-item">
                    <div>
                        <div>
                            <a href="{{ route('posts.show', $post->id) }}">
                            <h2 class="post-title">{{ $post->title }}</h2>
                            <p class="post-body">{{ $post->body }}</p>
                            </a>
                        </div>
                        <div class="post-actions">
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn-edit">Editar</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Tem certeza que deseja deletar o Post?')">Deletar</button>
                                </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        @else
            <p>Nenhum post encontrado. Crie o primeiro!</p>
    @endif

@endsection
