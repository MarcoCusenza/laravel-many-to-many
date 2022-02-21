@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('tags.create') }}" class="btn btn-success mb-3">Crea Nuovo Tag</a>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <th scope="row">{{ $tag->id }}</th>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->slug }}</td>
                        <td>
                            <a href="{{ route('tags.show', $tag->id) }}" class="btn btn-primary">Visualizza</a>
                            <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-warning">Modifica</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
