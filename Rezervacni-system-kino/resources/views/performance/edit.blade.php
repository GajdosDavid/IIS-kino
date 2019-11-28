@extends('base')

@section('title', 'Editace představení ' . $performance->title)
@section('description', 'Editor pro editaci představení.')

@section('content')
    <h1>Editace představení {{ $performance->title }}</h1>

    <form action="{{ route('performance.update', ['performance' => $performance]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Název</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?: $performance->name }}" required minlength="1" maxlength="300" />
        </div>

        <div class="form-group">
            <label for="date">Datum ve formátu YYYY-MM-DD</label>
            <input type="text" name="date" id="date" class="form-control" value="{{ old('date') ?: $performance->date }}"/>
        </div>

        <div class="form-group">
            <label for="beginning">Začátek</label>
            <input type="text" name="beginning" id="beginning" class="form-control" value="{{ old('beginning') ?: $performance->beginning }}" />
        </div>

        <div class="form-group">
            <label for="end">Konec</label>
            <input type="text" name="end" id="end" class="form-control" value="{{ old('end') ?: $performance->end }}" />
        </div>

        <div class="form-group">
            <label for="price">Cena</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ old('price') ?: $performance->price }}" />
        </div>

        <div class="form-group">
            <label for="type">Druh</label>
            <input type="text" name="type" id="type" class="form-control" value="{{ old('type') ?: $performance->type }}" required minlength="1" maxlength="50" />
        </div>

        <div class="form-group">
            <label for="description">Popis</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') ?: $performance->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="genre">Žánr</label>
            <input type="text" name="genre" id="genre" class="form-control" value="{{ old('genre') ?: $performance->genre }}" required minlength="1" maxlength="50" />
        </div>

        <div class="form-group">
            <label for="performer">Účinkující</label>
            <input type="text" name="performer" id="performer" class="form-control" value="{{ old('performer') ?: $performance->performer }}" required minlength="1" maxlength="500" />
        </div>

        <div class="form-group">
            <label for="image">Obrázek</label>
            <input type="file" name="image" id="image" class="form-control" value="{{ old('image') ?: $performance->image }}" />
        </div>

        <button type="submit" class="btn btn-primary">Uložit představení</button>
    </form>
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
