@extends('layouts.app')

@section('title', 'Editace sálů ' . $hall->title)
@section('description', 'Editor pro editaci sálů.')

@section('content')
    <h1>Editace sálů {{ $hall->title }}</h1>

    <form action="{{ route('hall.update', ['hall' => $hall]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Název sálu</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?: $hall->name }}" required minlength="3" maxlength="50" />
        </div>

        <div class="form-group">
            <label for="address">Adresa</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address') ?: $hall->address }}" required minlength="1" maxlength="50" />
        </div>

        <div class="form-group">
            <label for="capacity">Kapacita</label>
            <input type="text" name="capacity" id="capacity" class="form-control" value="{{ old('capacity') ?: $hall->capacity }}" required minlength="1" maxlength="2500" />
        </div>

        <div class="form-group">
            <label for="rows">Řady</label>
            <input type="text" name="rows" id="rows" class="form-control" value="{{ old('rows') ?: $hall->rows }}" required minlength="1" maxlength="50" />
        </div>

        <div class="form-group">
            <label for="seatsInRow">Sedadla v řadě</label>
            <input type="text" name="seatsInRow" id="seatsInRow" class="form-control" value="{{ old('seatsInRow') ?: $hall->seatsInRow }}" required minlength="1" maxlength="50" />
        </div>

        <button type="submit" class="btn btn-primary">Uložit sál</button>
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
