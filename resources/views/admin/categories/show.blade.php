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
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td class="d-flex">
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning mr-1">Modifica</a>
                        {{-- Pulsante Elimina --}}
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
