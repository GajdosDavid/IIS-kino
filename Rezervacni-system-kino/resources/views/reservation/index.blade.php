@extends('layouts.app')

@section('title', 'Seznam rezervací')
@section('description', 'Výpis všech rezervací v administraci.')

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        @if (Auth::user()->role == 3 || Auth::user()->role == 1 )
            <div class="administration">
                <br>
                <input type="text" id="searchReservations" onkeyup="searchTable()" placeholder="Hledejte v rezervacích..">
                <br>
                <br>
                <table id="reservations" class="table table-striped table-bordered table-responsive-md">
                    <thead>
                    <tr>
                        <th>Příjmení</th>
                        <th>Jméno</th>
                        <th>Události</th>
                        <th>Sál</th>
                        <th>Datum</th>
                        <th>Začátek</th>
                        <th>Sedadla "řada, sedadlo"</th>
                        <th>Cena</th>
                        <th>Zaplaceno</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($reservations as $reservation)
                        <tr>
                            <td>{{ $users->contains('id', $reservation->user_id) ? $users->find($reservation->user_id)->surname : $reservation->surname}}</td>
                            <td>{{ $users->contains('id', $reservation->user_id) ? $users->find($reservation->user_id)->first_name  : $reservation->first_name}}</td>
                            <td>{{ $reservation->performance->piece->name }}</td>
                            <td>{{ $reservation->hall->name }}</td>
                            <td>{{ $reservation->performance->date }}</td>
                            <td>{{ date('G:i', strtotime( $reservation->performance->beginning )) }}</td>
                            <td>{{ json_encode($reservation->seats) }}</td>
                            <td>{{ $reservation->performance->price * count($reservation->seats) }} Kč</td>
                            <td>{{ $reservation->is_paid ? 'Ano' : 'Ne' }}</td>
                            <td>
                                <a href="{{ route('reservation.show', ['reservation' => $reservation]) }}">Detail</a>

                                @if(!$reservation->is_paid)
                                    <a href="{{ route('reservation.pay', ['reservation' => $reservation]) }}" style="display: inline">Zaplatit</a>
                                @endif

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
                            <td colspan="10" class="text-center">
                                Zadne rezervace
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <h1>K této stránce nemáte přístup</h1>
        @endif
    @endguest
@endsection

@push('scripts')
    <script>
        function searchTable() {

            let input, filter, table, tr, td, i, j, cell;
            input = document.getElementById("searchReservations");
            filter = input.value.toUpperCase();
            table = document.getElementById("reservations");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {

                tr[i].style.display = "none";

                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length -1; j++) {
                    cell = tr[i].getElementsByTagName("td")[j];
                    if (cell) {
                        if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        }
    </script>
@endpush
