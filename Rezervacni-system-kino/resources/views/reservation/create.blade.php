@extends('layouts.app')

@section('title', 'Tvorba rezervace')
@section('description', 'Editor pro vytvoření nové rezervace.')

@section('content')
    @php
        $date = new Carbon\Carbon($performance->date)
    @endphp

    <div class="seats-piece">
        <div class="header">
            <div class="bg">
                <img src="{{asset('img/'.$performance->piece->image)}}" class="image">
            </div>
            <div class="image-block">
                <img src="{{asset('img/'.$performance->piece->image)}}" class="image" >
            </div>
        </div>
        <div class="seats flex-column">
            <h2>{{$performance->piece->name}}</h2>
            <p class="date">{{ $date->isoFormat('LL') }} {{ date('G:i', strtotime($performance->beginning)) }}</p>
            <p class="price">Cena za jeden lístek: {{$performance->price}}</p>
            <p class="hall-header">Sál: {{$hall->name}}</p>


            <form action="{{ route('reservation.store') }}" method="POST" class="form-seats flex-column">
                @csrf
                <div class="cinema-room">
                    <div class="cinema-wall">
                        <p>plátno</p>
                    </div>
                    <div class="seats-rows">
                    @for( $row = 1; $row <= $hall->rows ; $row++)
                        <div class="flex-row seats-row">
                            <div class="seats-col">{{$row}}</div>

                        @for( $seat = 1; $seat <= $hall->seats_in_row ; $seat++)
                            @if( in_array("$row,$seat", $reservedSeats) )
                                <div class="full seats-col">
                                    <input type="checkbox" disabled class="check">
                                </div>
                            @else
                                <div class="seats-col">
                                    <input type="checkbox" name="seats[]" id="seats[]" value="{{$row}},{{$seat}}" class="check">
                                </div>
                            @endif
                        @endfor
                        </div>
                    @endfor
                        <div class="col-numbers flex-row seats-row">
                            <div class="seats-col"></div>
                            @for( $seat = 1; $seat <= $hall->seats_in_row ; $seat++)
                                <div class="seats-col">{{$seat}}</div>
                            @endfor
                        </div>
                    </div>
                    <div class="explained flex-row">
                        <div class="item flex-row">
                            <div class="box taken"></div>
                            <h6>Zabráno / Nedostupné</h6>
                        </div>
                        <div class="item flex-row">
                            <div class="box available"></div>
                            <h6>Dostupné</h6>
                        </div>
                    </div>
                </div>
                @guest
                <div class="guest">
                    <div class="form-group flex-row">
                        <div class="input-block">
                            <label for="first_name">Jméno *</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" required minlength="1" maxlength="30" />
                        </div>
                        <div  class="input-block">
                            <label for="surname">Přijmení *</label>
                            <input type="text" name="surname" id="surname" class="form-control" value="{{ old('surname') }}" required minlength="1" maxlength="30" />
                        </div>
                    </div>

                    <div class="form-group flex-row">
                        <div class="input-block">
                            <label for="phone">Telefonní číslo</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" minlength="4" maxlength="20" />
                        </div>
                        <div class="input-block">
                            <label for="email">Email *</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" maxlength="255" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-block full">
                            <label for="password">Heslo (nutné jen pro registraci)</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-block full">
                            <label for="password-confirm">Potvrdit heslo (nutné jen pro registraci)</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>

                    <div class="submit-buttons">
                        <button type="submit" name="register" value="register" onclick="form.action='{{ route('register') }}';" class="button">Registrovat se</button>
                        <button type="submit" class="button">Dokončit bez registrace</button>
                    </div>

                </div>
                @else
                    <div class="submit-buttons">
                        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}"/>
                        <button type="submit" class="button">Vytvořit rezervaci</button>
                    </div>
                @endguest
                    <input type="hidden" name="hall_id" id="hall_id" value="{{ $hall->id }}" />
                    <input type="hidden" name="performance_id" id="performance_id" value="{{ $performance->id }}" />
            </form>
        </div>
    </div>



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
