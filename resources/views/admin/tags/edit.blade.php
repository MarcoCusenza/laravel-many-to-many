@extends('layouts.app')


@section('content')
    <div class="container">
        <form action="{{ route('tags.update', $tag->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="exampleInputEmail1">Modifica Tag</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="tagName"
                    placeholder="Enter Tag Name" value="{{ old('name') ? old('name') : $tag->name }}">
                <small id="tagName" class="form-text text-muted">Inserisci qui il nome del tag che vuoi
                    modificare</small>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Modifica</button>
        </form>
    </div>
@endsection
