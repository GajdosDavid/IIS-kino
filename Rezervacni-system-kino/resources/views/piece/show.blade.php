@extends('layouts.app')

@section('title', $piece->name)
@section('description', $piece->description)

@section('content')


<div class="concrete-piece flex-column">
    <div class="piece-bg">
        <img src="{{asset('img/'.$piece->image)}}" alt="$piece->name" class="image">
    </div>
    <div class="piece-info">
        <div class="piece-info-header flex-row">
            <div class="piece-image">
                <img src="{{asset('img/'.$piece->image)}}" alt="$piece->name" class="image">
            </div>
            <div class="flex-column piece-text">
                    <h4>{{ $piece->type }}</h4>
                    <h1 class="piece-name">{{ $piece->name }}</h1>
                    <p class="description">{{ $piece->description }}</p>
                <!--

                -->
            </div>
        </div>
        <!--

        -->
    </div>
    <div class="piece-next-box">
        <div class="piece-next-info">
            <div class="availability flex-row">
                <p class="item genre">{{ $piece->genre }}</p>
                <p class="item">{{ $piece->length }} minut</p>
            </div>
        </div>
    </div>
    <div class="reservation-box">
        <div class="overview">
            <h2 class="">Zarezervuje si sedadlo</h2>
            <h5>Vyberte místo, kde chcete film zarezervovat</h5>
            <div class="cinema-dates flex-column">
                <div class="cinemas flex-row">
                    @foreach($halls as $hall)
                        <p onClick="changeCinema('{{$hall->id}}')" class="cinema-toggle {{$hall->id}}">{{$hall->name}} | {{$hall->address}}</p>
                    @endforeach
                </div>

                <div class="perf head flex-row">
                    <p class="item">Datum</p>
                    <p class="item">Čas</p>
                    <p class="item">Cena</p>
                    <p class="item"></p>
                </div>
                @foreach($halls as $hall)
                    <div class="pack {{$hall->id}}">

                        @foreach($performances as $perf)
                            @if ($perf->halls()->where('hall_id', $hall->id)->exists())
                            <a class="perf flex-row" href="{{ route('reservation.createOnPerformance', [$perf->id, $hall->id]) }}" >
                                <p class="item">{{$perf->date}}</p>
                                <p class="item">{{ date('G:i', strtotime($perf->beginning)) }}</p>
                                <p class="item">{{$perf->price}},-</p>
                                <div class="item">
                                    <button class="button">Zarezervovat</button>
                                </div>
                            </a>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="application/javascript">

        function changeCinema(x){

            $(".pack").fadeOut(200);
            $(".pack."+x).delay(300).fadeIn(200);
            $(".cinema-toggle").removeClass("selected");
            $(".cinema-toggle."+x).addClass("selected");

        }
    </script>
@endpush
