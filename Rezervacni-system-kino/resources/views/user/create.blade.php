@extends('layouts.app')

@section('title', 'Tvorba uživatele')
@section('description', 'Editor pro vytvoření nového uživatele.')

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        @if (Auth::user()->role == 3)
            <div class="administration-form">
                <br>
                <h1>Tvorba uživatele</h1>
                <br>

                <form action="{{ route('user.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="first_name">Jméno *</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" required minlength="1" maxlength="30" />
                    </div>

                    <div class="form-group">
                        <label for="surname">Přijmení *</label>
                        <input type="text" name="surname" id="surname" class="form-control" value="{{ old('surname') }}" required minlength="1" maxlength="30" />
                    </div>

                    <div class="form-group">
                        <label for="phone">Telefonní číslo</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" minlength="4" maxlength="20" />
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" maxlength="255" />
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

                    <div class="form-group">
                        <label for="role">Role *</label>
                        <select name="role" id="role" class="form-control" >
                            <option value="0">Divák</option>
                            <option value="1">Pokladní</option>
                            <option value="2">Redaktor</option>
                            <option value="3">Admin</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Vytvořit uživatele</button>
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
