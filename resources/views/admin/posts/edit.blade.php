@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Modifica Post</h1>

        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    placeholder="Inserisci il titolo del post" value="{{ old('title') ? old('title') : $post->title }}">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Testo del Post</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="6"
                    placeholder="Inserisci il testo del Post">{{ old('content') ? old('content') : $post->content }}</textarea>
                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category">Categoria</label>
                <select class="form-control form-control-md @error('category') is-invalid @enderror" id="category"
                    name="category_id">
                    @php
                        $selected = old('category') ? old('category') : $post->category_id;
                    @endphp
                    <option value="">Seleziona una categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $selected == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="published" name="published"
                    {{ $post->published ? 'checked' : '' }}>
                <label class="form-check-label" for="published">Pubblica</label>
            </div>

            <button type="submit" class="btn btn-warning">Modifica</button>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

@endsection
