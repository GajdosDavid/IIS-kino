@extends('layouts.app')

@section('title', 'Tvorba rezervace')
@section('description', 'Editor pro vytvoření nové rezervace.')

@section('content')
    <h1>Tvorba rezervace</h1>

    <form action="{{ route('reservation.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <h2>Sál {{$hall->name}}</h2>
            <br>
            <table>
                <col width="30">
                @for( $seat = 1; $seat <= $hall->seats_in_row ; $seat++)
                    <col width="25">
                @endfor
                <thead align="center">
                <tr>
                    <th></th>
                    @for( $seat = 1; $seat <= $hall->seats_in_row ; $seat++)
                        <th>{{$seat}}</th>
                    @endfor
                </tr>
                </thead>
                <tbody align="center">
                @for( $row = 1; $row <= $hall->rows ; $row++)
                    <tr>
                        <td>{{$row}}</td>
                        @for( $seat = 1; $seat <= $hall->seats_in_row ; $seat++)
                            @if( in_array("$row,$seat", $reservedSeats) )
                                <td style="background: red; border: 5px solid #FFFFFF; "/>
                            @else
                                <td>
                                    <input type="checkbox" name="seats[]" id="seats[]" value="{{$row}},{{$seat}}">
                                </td>
                            @endif
                        @endfor
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn btn-primary">Vytvořit rezervaci</button>
    </form>
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
