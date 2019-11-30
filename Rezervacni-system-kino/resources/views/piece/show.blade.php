@extends('layouts.app')

@section('title', $piece->name)
@section('description', $piece->description)

@section('content')
    <h1>{{ $piece->name }}</h1>
    <br>
    <br>

    <img src="/storage/{{$piece->image}}" alt="$piece->name" height="500">
    <br><br>
    <p>typ: {!! $piece->type !!}</p>
    <p>popis: {!! $piece->description !!}</p>
    <p>žánr: {!! $piece->genre !!}</p>
    <p>účinkující: {!! $piece->performer !!}</p>

    <a href="{{ route('reservation.create') }}" class="btn btn-primary">
        Vytvořit rezervaci
    </a>
@endsection
