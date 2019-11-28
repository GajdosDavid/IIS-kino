@extends('base')

@section('title', 'Seznam článků')
@section('description', 'Výpis všech článků v administraci.')

@section('content')
    <table class="table table-striped table-bordered table-responsive-md">
        <thead>
        <tr>
            <th>Jméno</th>
            <th>Popisek</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse ($performances as $performance)
            <tr>
                <td>
                    <a href="{{ route('performance.show', ['performance' => $performance]) }}">
                        {{ $performance->name }}
                    </a>
                </td>
                <td>{{ $performance->description }}</td>
                <td>
                    <a href="{{ route('performance.edit', ['performance' => $performance]) }}">Editovat</a>
                    <a href="#" onclick="event.preventDefault(); $('#performance-delete-{{ $performance->id }}').submit();">Odstranit</a>

                    <form action="{{ route('performance.destroy', ['performance' => $performance]) }}" method="POST" id="performance-delete-{{ $performance->id }}" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">
                    Nikdo zatím nevytvořil žádnou událost.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <a href="{{ route('performance.create') }}" class="btn btn-primary">
        Vytvořit novou událost
    </a>
@endsection
