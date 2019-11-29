@extends('base')

@section('title', 'Tvorba uživatele')
@section('description', 'Editor pro vytvoření nového uživatele.')

@section('content')
    <h1>Tvorba uživatele</h1>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="firstName">Jméno</label>
            <input type="text" name="firstName" id="firstName" class="form-control" value="{{ old('firstName') }}" required minlength="1" maxlength="30" />
        </div>

        <div class="form-group">
            <label for="surname">Přijmení</label>
            <input type="text" name="surname" id="surname" class="form-control" value="{{ old('surname') }}" required minlength="1" maxlength="30" />
        </div>

        <div class="form-group">
            <label for="phone">Telefonní číslo</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required minlength="4" maxlength="20" />
        </div>

        <div class="form-group">
            <label for="email">E-email</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" />
        </div>

        <div class="form-group">
            <label for="password">Heslo</label>
            <input type="text" name="password" id="password" class="form-control" required minlength="4" maxlength="50" />
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" />
                <option value="0">Divák</option>
                <option value="1">Pokladní</option>
                <option value="2">Redaktor</option>
                <option value="3">Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Vytvořit uživatele</button>
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
