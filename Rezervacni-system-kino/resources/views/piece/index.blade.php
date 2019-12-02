@extends('layouts.app')

@section('title', 'Seznam kulturních děl')
@section('description', 'Výpis všech kulturních děl v administraci.')

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        @if (Auth::user()->role == 3 || Auth::user()->role == 2 )
            <input type="text" id="searchPieces" onkeyup="myFunction()" placeholder="Hledejte v dílech...">
            <br>
            <br>
            <table id="pieces" class="table table-striped table-bordered table-responsive-md">
                <thead>
                <tr>
                    <th>Jméno</th>
                    <th>Typ</th>
                    <th>Žánr</th>
                    <th>Popisek</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($pieces as $piece)
                    <tr>
                        <td>{{ $piece->name }}</td>
                        <td>{{ $piece->type }}</td>
                        <td>{{ $piece->genre }}</td>
                        <td>{{ $piece->description }}</td>
                        <td>
                            <a href="{{ route('piece.show', ['piece' => $piece]) }}">Detail</a>
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
                            Nikdo zatím nevytvořil žádné kulturní dílo s naplánovanou událostí.
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

@push('scripts')
    <script>
        function myFunction() {

            let input, filter, table, tr, td, i, j, cell;
            input = document.getElementById("searchPieces");
            filter = input.value.toUpperCase();
            table = document.getElementById("pieces");
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
