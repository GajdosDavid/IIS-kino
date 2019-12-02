@extends('layouts.app')

@section('title', 'Kino jak sviňa')
@section('description', 'Kino pro pravé brňáky')

@section('content')

<section id="home flex-column">
    <h1 class="header-cinema">KINEMA CITY</h1>
    <div class="shade">
        <div class="panel flex-row">


            @foreach($pieces as $piece)
            <div class="image-block">
                <img src="{{asset('img/'.$piece->image)}}" alt="$piece->name" class="image">
            </div>

            @endforeach
        </div>
    </div>



    <div class="pieces flex-column">
        <div class="header">
            <h2>Nejnovější představení a filmy</h2>
        </div>
        <div class="concrete flex-row">
            @forelse ($pieces as $piece)

                <a href="{{ route('piece.show', ['piece' => $piece]) }}" class="block">
                    <div class="overlay">
                        <h3 class="name">{{$piece->name}}</h3>
                        <p class="type">{{$piece->type}}</p>
                        <p class="desc">{{$piece->description}}</p>
                        <p class="genre">{{$piece->genre}}</p>
                    </div>

                    <img src="{{asset('img/'.$piece->image)}}" alt="$piece->name" class="image">
                </a>
            @empty
                <p>Zatím se zde nenachází žádné kulturní dílo.</p>
            @endforelse
        </div>
    </div>


</section>

@endsection

@section('footer')
    <div class="footer-main">

    </div>
@endsection
