@extends('layouts.app')

@section('title', 'Seznam rezervací uživatele '.Auth::user()->first_name.' '.Auth::user()->surname)
@section('description', 'Výpis všech rezervací uživatele.')

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        <table class="table table-striped table-bordered table-responsive-md">
            <thead>
            <tr>
                <th>Událost</th>
                <th>Sál</th>
                <th>Datum</th>
                <th>Začátek</th>
                <th>Sedadla</th>
                <th>Zaplaceno</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($reservations as $reservation)
                <tr>
                    <td>{{ $performances->find($reservation->performance_id)->piece->name }}</td>
                    <td>{{ $halls->find($reservation->hall_id)->name }}</td>
                    <td>{{ $performances->find($reservation->performance_id)->date }}</td>
                    <td>{{ date('G:i', strtotime( $performances->find($reservation->performance_id)->beginning )) }}</td>
                    <td>{{ json_encode($reservation->seats) }}</td>
                    <td>{{ $reservation->is_paid ? 'Ano' : 'Ne' }}</td>
                    <td>
                        <a href="{{ route('reservation.show', ['reservation' => $reservation]) }}">Zobrazit</a>

                        @if(!$reservation->is_paid)
                            <form id="pay" action="{{ route('reservation.pay', ['reservation' => $reservation]) }}" method="POST">
                                @csrf
                                <a href="#" onclick="document.getElementById('pay').submit();">Zaplatit</a>
                            </form>
                        @endif
                        <a href="#" onclick="event.preventDefault(); $('#reservation-delete-{{ $reservation->id }}').submit();">Odstranit</a>

                        <form action="{{ route('reservation.destroy', ['reservation' => $reservation]) }}" method="POST" id="reservation-delete-{{ $reservation->id }}" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">
                        Zadne rezervace
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    @endguest
@endsection
