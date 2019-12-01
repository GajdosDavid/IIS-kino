@extends('layouts.app')

@section('title', 'Tvorba rezervace')
@section('description', 'Editor pro vytvoření nové rezervace.')

@section('content')
    @php
        $date = new Carbon\Carbon($performance->date)
    @endphp
    <h1>Tvorba rezervace na dílo {{$performance->piece->name}}</h1>
    <h2>{{ $date->isoFormat('LL') }} {{ date('G:i', strtotime($performance->beginning)) }}</h2>

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

        <input type="hidden" name="hall_id" id="hall_id" value="{{ $hall->id }}" />
        <input type="hidden" name="performance_id" id="performance_id" value="{{ $performance->id }}" />

        @guest
            <div class="form-group">
                <label for="first_name">Jméno *</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" required minlength="1" maxlength="30" />
            </div>

            <div class="form-group">
                <label for="surname">Přijmení *</label>
                <input type="text" name="surname" id="surname" class="form-control" value="{{ old('surname') }}" required minlength="1" maxlength="30" />
            </div>

            <div class="form-group">
                <label for="phone">Telefonní číslo</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" minlength="4" maxlength="20" />
            </div>

            <div class="form-group">
                <label for="email">E-email *</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" />
            </div>

            <div class="form-group">
                <label for="password">Heslo (nutné jen pro registraci)</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">Potvrdit heslo (nutné jen pro registraci)</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
            </div>

            <button type="submit" name="register" value="register" onclick="form.action='{{ route('register') }}';" class="btn btn-primary" >Registrovat se</button>

            <button type="submit" class="btn btn-primary">Dokončit bez registrace</button>

        @else
            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}" />
            <button type="submit" class="btn btn-primary">Vytvořit rezervaci</button>
        @endguest
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
