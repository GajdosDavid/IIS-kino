@extends('layouts.app')

@section('title', 'Editace rezervace ' . $reservation->title)
@section('description', 'Editor pro editaci rezervace.')

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        @if (Auth::user()->role == 3 || Auth::user()->role == 1 )
            <h1>Editace rezervace na událost {{ $reservation->performance->piece->name }}</h1>

            <form action="{{ route('reservation.update', ['reservation' => $reservation]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <h2>Sál {{$reservation->hall->name}}</h2>
                    <br>
                    <table>
                        <col width="30">
                        @for( $seat = 1; $seat <= $reservation->hall->seats_in_row ; $seat++)
                            <col width="25">
                        @endfor
                        <thead align="center">
                        <tr>
                            <th></th>
                            @for( $seat = 1; $seat <= $reservation->hall->seats_in_row ; $seat++)
                                <th>{{$seat}}</th>
                            @endfor
                        </tr>
                        </thead>
                        <tbody align="center">
                        @for( $row = 1; $row <= $reservation->hall->rows ; $row++)
                            <tr>
                                <td>{{$row}}</td>
                                @for( $seat = 1; $seat <= $reservation->hall->seats_in_row ; $seat++)
                                    @if( in_array("$row,$seat", $reservedSeats) && !in_array("$row,$seat", $reservation->seats))
                                        <td style="background: red; border: 5px solid #FFFFFF; "/>
                                    @else
                                        <td>
                                            <input type="checkbox" name="seats[]" id="seats[]" value="{{$row}},{{$seat}}
                                            {{ in_array("$row,$seat", $reservation->seats) ? 'checked' : '' }}">
                                        </td>
                                    @endif
                                @endfor
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>

                <button type="submit" class="btn btn-primary">Uložit rezervaci</button>
            </form>
        @else
            <h1>K této stránce nemáte přístup</h1>
        @endif
    @endguest
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('//cdn.tinymce.com/4/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#content',
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            entities: '160,nbsp',
            entity_encoding: 'raw'
        });
    </script>
@endpush
