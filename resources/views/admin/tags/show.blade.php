@extends('layouts.app')


@section('content')
    <div class="container">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Actions</th>
                    @if (count($tag->posts) > 0)
                        <th scope="col">Post Associati</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">{{ $tag->id }}</th>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->slug }}</td>
                    <td class="d-flex">
                        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-warning mr-1">Modifica</a>
                        {{-- Pulsante Elimina --}}
                        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </td>
                    @if (count($tag->posts) > 0)
                        <td>
                            <ul>
                                @foreach ($tag->posts as $post)
                                    <li>{{ $post->title }}</li>
                                @endforeach
                            </ul>
                        </td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
@endsection
