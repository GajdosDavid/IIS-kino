@extends('layouts.app')

@section('title', 'Seznam událostí')
@section('description', 'Výpis všech událostí v administraci.')

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        @if (Auth::user()->role == 3 || Auth::user()->role == 2 )
            <div class="administration">
                <br>
                <input type="text" id="searchPerformances" onkeyup="searchTable()" placeholder="Hledejte v událostech..">
                <br>
                <br>
                <table id="performances" class="table table-striped table-bordered table-responsive-md">
                    <thead>
                    <tr>
                        <th>Jméno díla</th>
                        <th>Datum</th>
                        <th>Začátek</th>
                        <th>Konec</th>
                        <th>Sály</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($performances as $performance)
                        <tr>
                            <td>{{ $performance->piece->name}}</td>
                            <td>{{ $performance->date }}</td>
                            <td>{{ date('G:i', strtotime($performance->beginning)) }}</td>
                            <td>{{ date('G:i', strtotime($performance->end)) }}</td>
                            <td>
                                @foreach ($performance->halls as $hall)
                                    {{ $hall->name}}<br>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('performance.show', ['performance' => $performance]) }}">Detail</a>
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
                            <td colspan="6" class="text-center">
                                Nikdo zatím nevytvořil žádnou událost.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <a href="{{ route('performance.create') }}" class="btn btn-primary">
                    Vytvořit novou událost
                </a>
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
            input = document.getElementById("searchPerformances");
            filter = input.value.toUpperCase();
            table = document.getElementById("performances");
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
