@extends('layouts.app')

@section('title', 'Seznam událostí')
@section('description', 'Výpis všech událostí v administraci.')

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        @if (Auth::user()->role == 3 || Auth::user()->role == 2 )
            <table class="table table-striped table-bordered table-responsive-md">
                <thead>
                <tr>
                    <th>Jméno díla</th>
                    <th>Datum</th>
                    <th>Začátek</th>
                    <th>Sály</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($performances as $performance)
                    <tr>
                        <td>{{ $pieces->find($performance->piece_id)->name}}</td>
                        <td>{{ $performance->date }}</td>
                        <td>{{ date('G:i', strtotime($performance->beginning)) }}</td>
                        <td>
                            @foreach ($performance->halls as $hall)
                                {{ $hall->name}}<br>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('performance.show', ['performance' => $performance]) }}">Zobrazit</a>
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
        @else
            <h1>K této stránce nemáte přístup</h1>
        @endif
    @endguest
@endsection
