@extends('layouts.app')


@section('content')
    <div class="container">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="text-light" for="exampleInputEmail1">Nome Nuova Categoria</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="categoryName"
                    placeholder="Enter Category name" value="{{ old('name') }}">
                <small id="categoryName" class="form-text text-muted">Inserisci qui il nome della categoria che vuoi
                    creare</small>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Crea</button>
        </form>
    </div>
@endsection
