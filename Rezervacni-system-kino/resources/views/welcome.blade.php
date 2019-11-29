@extends('base')

@section('title', 'Jednoduchý redakční systém v Laravel')
@section('description', 'Ukázkový tutoriál pro jednoduchý redakční systém v Laravel frameworku z programátorské sociální sítě itnetwork.cz')

@section('content')
    <h1 class="text-center mb-4">Jednoduchý redakční systém v Laravel</h1>

    @forelse ($performances as $performance)
        <div class="performance mb-5">
            <header>
                <h2>
                    <a href="{{ route('performance.show', ['performance' => $performance]) }}">{{ $performance->name }}</a>
                </h2>
            </header>
            <img src="/storage/{{$performance->image}}" alt="$performance->name" height="300">

            <p class="performance-content mb-1">{{ $performance->description }}</p>

        </div>
    @empty
        <p>Zatím se zde nenachází žádná představení.</p>
    @endforelse
@endsection
