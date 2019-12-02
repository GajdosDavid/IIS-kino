@extends('layouts.app')

@section('title', 'Změna hesla uživatele' . Auth::user()->first_name . " ".Auth::user()->surname)
@section('description', 'Změna hesla')

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        <div class="administration-form">
            <br>
            <h1>Editace uživatele {{ Auth::user()->first_name. " ".Auth::user()->surname }}</h1>

            <form action="{{ route('change.password') }}" method="POST" >
                @csrf

                <div class="form-group">
                    <label for="current_password">Stávající heslo *</label>
                    <input id="current_password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                </div>

                <div class="form-group">
                    <label for="password">Heslo *</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm">Potvrdit heslo *</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>

                <button type="submit" class="btn btn-primary">Uložit heslo</button>
            </form>
        </div>
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
