@extends('layouts.app')

@section('title', 'Seznam uživatelů')
@section('description', 'Výpis všech uživatelů v administraci.')

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        @if (Auth::user()->role == 3)
            <div class="administration">
                <br>
                <input type="text" id="searchUsers" onkeyup="searchTable()" placeholder="Hledejte v uživatelích...">
                <br>
                <br>
                <table class="table table-striped table-bordered table-responsive-md">
                    <thead>
                    <tr>
                        <th>Přijmení</th>
                        <th>Jméno</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->surname }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>
                                @if($user->role == 0)
                                    Divák
                                @elseif($user->role == 1)
                                    Pokladní
                                @elseif($user->role == 2)
                                    Redaktor
                                @elseif($user->role == 3)
                                    Admin
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('user.show', ['user' => $user]) }}">Detail</a>
                                <a href="{{ route('user.edit', ['user' => $user]) }}">Editovat</a>
                                <a href="#" onclick="event.preventDefault(); $('#user-delete-{{ $user->id }}').submit();">Odstranit</a>

                                <form action="{{ route('user.destroy', ['user' => $user]) }}" method="POST" id="user-delete-{{ $user->id }}" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                Nikdo zatím nevytvořil žádného uživatele.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <a href="{{ route('user.create') }}" class="btn btn-primary">
                    Vytvořit nového uživatele
                </a>
            </div>
        @else
            <h1>K této stránce nemáte přístup</h1>
        @endif
    @endguest
@endsection
