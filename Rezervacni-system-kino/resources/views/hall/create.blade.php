@extends('layouts.app')

@section('title', 'Tvorba sálu')
@section('description', 'Editor pro vytvoření nového sálu.')


@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        @if (Auth::user()->role == 3 || Auth::user()->role == 2 )
            <div class="administration-form">
                <br>
                <h1>Tvorba sálu</h1>
                <br>

                <form action="{{ route('hall.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Název sálu *</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required minlength="3" maxlength="50" />
                    </div>

                    <div class="form-group">
                        <label for="address">Adresa</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" minlength="1" maxlength="50" />
                    </div>

                    <div class="form-group">
                        <label for="rows">Řady *</label>
                        <input type="text" name="rows" id="rows" class="form-control" value="{{ old('rows') }}" required minlength="1" maxlength="50" />
                    </div>

                    <div class="form-group">
                        <label for="seats_in_row">Sedadla v řadě *</label>
                        <input type="text" name="seats_in_row" id="seats_in_row" class="form-control" value="{{ old('seats_in_row') }}" required minlength="1" maxlength="50" />
                    </div>

                    <button type="submit" class="btn btn-primary">Vytvořit sál</button>
                </form>
            </div>
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
