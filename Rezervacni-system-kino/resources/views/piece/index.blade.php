@extends('layouts.app')

@section('title', 'Seznam kulturních děl')
@section('description', 'Výpis všech kulturních děl v administraci.')

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        @if (Auth::user()->role == 3 || Auth::user()->role == 2 )
            <table class="table table-striped table-bordered table-responsive-md">
                <thead>
                <tr>
                    <th>Jméno</th>
                    <th>Popisek</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($pieces as $piece)
                    <tr>
                        <td>{{ $piece->name }}</td>
                        <td>{{ $piece->description }}</td>
                        <td>
                            <a href="{{ route('piece.show', ['piece' => $piece]) }}">Zobrazit</a>
                            <a href="{{ route('piece.edit', ['piece' => $piece]) }}">Editovat</a>
                            <a href="#" onclick="event.preventDefault(); $('#piece-delete-{{ $piece->id }}').submit();">Odstranit</a>

                            <form action="{{ route('piece.destroy', ['piece' => $piece]) }}" method="POST" id="piece-delete-{{ $piece->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            Nikdo zatím nevytvořil žádné kulturní dílo.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <a href="{{ route('piece.create') }}" class="btn btn-primary">
                Vytvořit nové kulturní dílo
            </a>
        @else
            <h1>K této stránce nemáte přístup</h1>
        @endif
    @endguest
@endsection
