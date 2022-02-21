@extends('layouts.app')


@section('content')
    <div class="container">
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="exampleInputEmail1">Modifica Categoria</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="categoryName"
                    placeholder="Enter Category name" value="{{ old('name') ? old('name') : $category->name }}">
                <small id=" categoryName" class="form-text text-muted">Inserisci qui il nome della categoria che vuoi
                    modificare</small>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Crea</button>
        </form>
    </div>
@endsection
