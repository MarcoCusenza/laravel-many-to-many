@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="card">
                <div class="card-header">{{ __('Post') }}</div>
                <div class="card-body">
                    <div class="card" style="width: 40rem;">
                        @if ($post->image)
                            <img src="{{ asset("storage/{$post->image}") }}" class="card-img-top"
                                alt="{{ $post->title }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                            @if ($post->published)
                                <span class="badge badge-success">Pubblico</span>
                            @else
                                <span class="badge badge-secondary">Privato</span>
                            @endif

                            @if ($post->category)
                                <p class="card-text bg-info">Categoria: {{ $post->category->name }}</p>
                            @endif

                            <div class="btn-container d-flex my-3">
                                {{-- Pulsante Modifica --}}
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning mr-2">Modifica</a>

                                {{-- Pulsante Elimina --}}
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger">Elimina</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
