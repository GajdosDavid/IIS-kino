@extends('layouts.app')

@section('title', 'Seznam rezervací uživatele '.Auth::user()->firstName.' '.Auth::user()->surname)
@section('description', 'Výpis všech rezervací uživatele.')

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        <table class="table table-striped table-bordered table-responsive-md">
            <thead>
            <tr>
                <th>Představení</th>
                <th>datum</th>
                <th>začátek</th>
                <th>sedadla</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($reservations as $reservation)
                <tr>
                    <td>{{ $performances->find($reservation->performanceId)->name }}</td>
                    <td>{{ $performances->find($reservation->performanceId)->date }}</td>
                    <td>{{ date('G:i', strtotime( $performances->find($reservation->performanceId)->beginning )) }}</td>
                    <td>{{ $reservation->seats }}</td>
                    <td>
                        <a href="{{ route('reservation.show', ['reservation' => $reservation]) }}">Zobrazit</a>
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
    @endguest
@endsection
