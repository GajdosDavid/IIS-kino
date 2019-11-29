@extends('layouts.app')

@section('title', 'Editace rezervace ' . $reservation->title)
@section('description', 'Editor pro editaci rezervace.')

@section('content')
    <h1>Editace představení {{ $reservation->title }}</h1>

    <form action="{{ route('reservation.update', ['reservation' => $reservation]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="date">Datum</label>
            <input type="text" name="date" id="date" class="form-control" value="{{ old('date') ?: $reservation->date }}" />
        </div>

        <div class="form-group">
            <label for="seats">Sedačky</label>
            <input type="text" name="seats" id="seats" class="form-control" value="{{ old('seats') ?: $reservation->seats }}" />
        </div>


        <button type="submit" class="btn btn-primary">Uložit rezervaci</button>
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
