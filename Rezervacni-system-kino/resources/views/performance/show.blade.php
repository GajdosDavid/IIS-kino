@extends('layouts.app')

@section('title', $performance->name)
@section('description', $performance->description)

@section('content')
    {{ $performance->name }}
    <br>

    <img src="/storage/{{$performance->image}}" alt="$performance->name" height="500">
    <br>
    <p>{!! $performance->description !!}</p>

    <a href="{{ route('reservation.create') }}" class="btn btn-primary">
        Vytvořit rezervaci
    </a>
@endsection
