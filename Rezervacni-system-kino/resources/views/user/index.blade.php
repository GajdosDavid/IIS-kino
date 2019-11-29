@extends('layouts.app')

@section('title', 'Seznam uživatelů')
@section('description', 'Výpis všech uživatelů v administraci.')

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        @if (Auth::user()->role == 3)
            <table class="table table-striped table-bordered table-responsive-md">
                <thead>
                <tr>
                    <th>Přijmení</th>
                    <th>Jméno</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->firstName }}</td>
                        <td>
                            <a href="{{ route('user.show', ['user' => $user]) }}">Zobrazit</a>
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
        @else
            <h1>K této stránce nemáte přístup</h1>
        @endif
    @endguest
@endsection
