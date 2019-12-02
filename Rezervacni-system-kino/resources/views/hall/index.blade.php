@extends('layouts.app')

@section('title', 'Seznam sálů')
@section('description', 'Výpis všech sálů v administraci.')

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        @if (Auth::user()->role == 3 || Auth::user()->role == 2 )
            <div class="administration">
                <br>
                <input type="text" id="searchHalls" onkeyup="searchTable()" placeholder="Hledejte v sálech..">
                <br>
                <br>
                <table id="halls" class="table table-striped table-bordered table-responsive-md">
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
                                <a href="{{ route('hall.show', ['hall' => $hall]) }}">Detail</a>
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
            input = document.getElementById("searchHalls");
            filter = input.value.toUpperCase();
            table = document.getElementById("halls");
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
