@extends('layouts.app')

@section('title', 'Seznam rezervací')
@section('description', 'Výpis všech rezervací v administraci.')

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        @if (Auth::user()->role == 3 || Auth::user()->role == 1 )
            <table class="table table-striped table-bordered table-responsive-md">
                <thead>
                <tr>
                    <th>datum</th>
                    <th>sedadla</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->date }}</td>
                        <td>{{ $reservation->seats }}</td>
                        <td>
                            <a href="{{ route('reservation.show', ['reservation' => $reservation]) }}">Zobrazit</a>
                            <a href="{{ route('reservation.edit', ['reservation' => $reservation]) }}">Editovat</a>
                            <a href="#" onclick="event.preventDefault(); $('#reservation-delete-{{ $reservation->id }}').submit();">Odstranit</a>

                            <form action="{{ route('reservation.destroy', ['reservation' => $reservation]) }}" method="POST" id="reservation-delete-{{ $reservation->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            Zadne rezervace
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <a href="{{ route('reservation.create') }}" class="btn btn-primary">
                Vytvořit rezervaci
            </a>
        @else
            <h1>K této stránce nemáte přístup</h1>
        @endif
    @endguest
@endsection
