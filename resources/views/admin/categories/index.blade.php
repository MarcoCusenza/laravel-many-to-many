@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">Crea Nuova Categoria</a>
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
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-primary">Visualizza</a>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Modifica</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
