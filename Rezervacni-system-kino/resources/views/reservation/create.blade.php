@extends('layouts.app')

@section('title', 'Tvorba rezervace')
@section('description', 'Editor pro vytvoření nové rezervace.')

@section('content')
    <h1>Tvorba rezervace</h1>

    <form action="{{ route('reservation.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="seats">Sedačky *</label>
            <input type="text" name="seats" id="seats" class="form-control" value="{{ old('seats') }}" />
        </div>

        <button type="submit" class="btn btn-primary">Vytvořit rezervaci</button>
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
