@extends('layouts.app')
@section('title','Listagem de posts')

@section('content')

    <h1 class="title">Criar novo post</h1>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title" class="form-label">Título do post:</label>
            <input type="text" id="title" name="title" class="form-input" value="{{ old('title') }}">

            @error('title')
            <span class="alert-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="body" class="form-label">Conteúdo:</label>
            <textarea name="body" id="body" rows="5" class="form-textarea">{{ old('body') }}</textarea>

            @error('body')
                <span class="alert-error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Criar Post</button>
    </form>

@endsection
