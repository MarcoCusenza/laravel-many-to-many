@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-content-center">
                        <div class="title" style="line-height: 35px">Tutti i post</div>
                        <a href="{{ route('posts.create') }}" class="btn btn-success">Crea Post</a>
                    </div>

                    <div class="card-body row p-5 ">
                        @foreach ($posts as $post)
                            <div class="card col-6 p-3" style="width: 18rem;">
                                @if ($post->image)
                                    <img src="{{ asset("storage/{$post->image}") }}" class="card-img-top"
                                        alt="{{ $post->title }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ $post->content }}</p>
                                    @if ($post->category)
                                        <p class="card-text bg-info text-center text-light">Categoria:
                                            {{ $post->category->name }}</p>
                                    @endif

                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Visualizza</a>
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Modifica</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
