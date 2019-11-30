@extends('layouts.app')

@section('title', 'Editace uživatelů pro Admina ' . $user->first_name . " ".$user->surname)
@section('description', 'Editor pro editaci uživatelů pro Admina.')

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        @if (Auth::user()->id == $user->id || Auth::user()->role == 3)
            <h1>Editace uživatele {{ $user->first_name. " ".$user->surname }}</h1>

            <form action="{{ route('user.update', ['user' => $user]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="first_name">Jméno *</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') ?: $user->first_name }}" required minlength="1" maxlength="30" />
                </div>

                <div class="form-group">
                    <label for="surname">Přijmení *</label>
                    <input type="text" name="surname" id="surname" class="form-control" value="{{ old('surname') ?: $user->surname }}" required minlength="1" maxlength="30" />
                </div>

                <div class="form-group">
                    <label for="phone">Telefonní číslo</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') ?: $user->phone }}" minlength="4" maxlength="20" />
                </div>

                @if (Auth::user()->role == 3)
                    <div class="form-group">
                        <label for="role">Role *</label>
                        <select name="role" id="role" class="form-control" >
                            <option value="0" {{ ($user->role == 0) ? "selected" : ""}}>Divák</option>
                            <option value="1" {{ ($user->role == 1) ? "selected" : ""}}>Pokladní</option>
                            <option value="2" {{ ($user->role == 2) ? "selected" : ""}}>Redaktor</option>
                            <option value="3" {{ ($user->role == 3) ? "selected" : ""}}>Admin</option>
                        </select>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary">Uložit uživatele</button>
            </form>
            <br>
            <button class="btn btn-danger" onclick="$('#user-delete-{{ $user->id }}').submit();">Smazat účet</button>

            <form action="{{ route('user.destroy', ['user' => $user]) }}" method="POST" id="user-delete-{{ $user->id }}" class="d-none">
                @csrf
                @method('DELETE')
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
