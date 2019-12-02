@extends('layouts.app')

@section('title', 'Editace kulturní dílo ' . $piece->title)
@section('description', 'Editor pro editaci kulturní dílo.')

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        @if (Auth::user()->role == 3 || Auth::user()->role == 2 )
            <h1>Editace kulturního díla {{ $piece->title }}</h1>

            <form action="{{ route('piece.update', ['piece' => $piece]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Název *</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?: $piece->name }}" required minlength="1" maxlength="300" />
                </div>

                <div class="form-group">
                    <label for="type">Druh</label>
                    <input type="text" name="type" id="type" class="form-control" value="{{ old('type') ?: $piece->type }}" minlength="1" maxlength="50" />
                </div>

                <div class="form-group">
                    <label for="description">Popis</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') ?: $piece->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="length">Délka v minutách</label>
                    <input type="text" name="length" id="length" class="form-control" value="{{ old('length') ?: $piece->length }}" minlength="1" maxlength="50" />
                </div>

                <div class="form-group">
                    <label for="genre">Žánr</label>
                    <input type="text" name="genre" id="genre" class="form-control" value="{{ old('genre') ?: $piece->genre }}" minlength="1" maxlength="50" />
                </div>

                <div class="form-group">
                    <label for="performer">Účinkující</label>
                    <input type="text" name="performer" id="performer" class="form-control" value="{{ old('performer') ?: $piece->performer }}" minlength="1" maxlength="500" />
                </div>

                <div class="form-group">
                    <label for="image">Obrázek *</label>
                    <input type="file" name="image" id="image" class="form-control" value="{{ old('image') ?: $piece->image }}" />
                </div>

                <button type="submit" class="btn btn-primary">Uložit kulturní dílo</button>
            </form>
        @else
            <h1>K této stránce nemáte přístup</h1>
        @endif
    @endguest
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('//cdn.tinymce.com/4/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#content',
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            entities: '160,nbsp',
            entity_encoding: 'raw'
        });
    </script>
@endpush
