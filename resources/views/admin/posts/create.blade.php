@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Crea un nuovo Post</h1>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    placeholder="Inserisci il titolo del post" value="{{ old('title') }}">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Testo del Post</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="6"
                    placeholder="Inserisci il testo del Post">{{ old('content') }}</textarea>
                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category">Categoria</label>
                <select class="form-control form-control-md @error('category') is-invalid @enderror" id="category"
                    name="category_id">
                    <option value="">Seleziona una categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="published" name="published"
                    {{ old('published') ? 'checked' : '' }}>
                <label class="form-check-label" for="published">Pubblica</label>
            </div>

            <div class="form-group">
                <img id="uploadPreview" width="100" src="https://via.placeholder.com/300x200">
                <label for="image">Aggiungi immagine</label>
                <input type="file" id="image" name="image" onchange="PreviewImage();">

                <script type="text/javascript">
                    function PreviewImage() {
                        var oFReader = new FileReader();
                        oFReader.readAsDataURL(document.getElementById("image").files[0]);

                        oFReader.onload = function(oFREvent) {
                            document.getElementById("uploadPreview").src = oFREvent.target.result;
                        };
                    };
                </script>
            </div>


            <button type="submit" class="btn btn-primary">Crea</button>

        </form>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

@endsection
