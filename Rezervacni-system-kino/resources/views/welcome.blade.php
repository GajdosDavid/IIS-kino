@extends('layouts.app')

@section('title', 'Kino jak sviňa')
@section('description', 'Kino pro pravé brňáky')

@section('content')
    <h1 class="text-center mb-4">Kino jak sviňa</h1>

    @forelse ($pieces as $piece)
        <div class="piece mb-5">
            <header>
                <h2>
                    <a href="{{ route('piece.show', ['piece' => $piece]) }}">{{ $piece->name }}</a>
                </h2>
            </header>
            <a href="{{ route('piece.show', ['piece' => $piece]) }}">
                <img src="{{asset('img/'.$piece->image)}}" alt="$piece->name" height="300">
            </a>
            <p class="piece-content mb-1">{{ $piece->description }}</p>

        </div>
    @empty
        <p>Zatím se zde nenachází žádné kulturní dílo.</p>
    @endforelse
@endsection
