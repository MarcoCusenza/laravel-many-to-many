@extends('layouts.app')


@section('content')
    <div class="container">
        <form action="{{ route('tags.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="exampleInputEmail1" class="text-light">Nome Nuovo Tag</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="tagName"
                    placeholder="Enter Tag name" value="{{ old('name') }}">
                <small id="tagName" class="form-text text-muted">Inserisci qui il nome del tag che vuoi
                    creare</small>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Crea</button>
        </form>
    </div>
@endsection
