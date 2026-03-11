@extends('layouts.app')
@section('title','Editar Post')

@section('content')

    <h1 class="title">Editar post</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title" class="form-label">Título do post:</label>
            <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $post->title) }}">

            @error('title')
            <span class="alert-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="body" class="form-label">Conteúdo:</label>
            <textarea name="body" id="body" rows="5" class="form-textarea">{{ old('body', $post->body) }}</textarea>

            @error('body')
                <span class="alert-error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Editar Post</button>
    </form>

@endsection
