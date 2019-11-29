@extends('layouts.app')

@section('title', 'Seznam sálů')
@section('description', 'Výpis všech sálů v administraci.')

@section('content')
    <table class="table table-striped table-bordered table-responsive-md">
        <thead>
        <tr>
            <th>Jméno</th>
            <th>Adresa</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse ($halls as $hall)
            <tr>
                <td>{{ $hall->name }}</td>
                <td>{{ $hall->address }}</td>
                <td>
                    <a href="{{ route('hall.show', ['hall' => $hall]) }}">Zobrazit</a>
                    <a href="{{ route('hall.edit', ['hall' => $hall]) }}">Editovat</a>
                    <a href="#" onclick="event.preventDefault(); $('#hall-delete-{{ $hall->id }}').submit();">Odstranit</a>

                    <form action="{{ route('hall.destroy', ['hall' => $hall]) }}" method="POST" id="hall-delete-{{ $hall->id }}" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">
                    Nikdo zatím nevytvořil žádný sál.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <a href="{{ route('hall.create') }}" class="btn btn-primary">
        Vytvořit nový sál
    </a>
@endsection
