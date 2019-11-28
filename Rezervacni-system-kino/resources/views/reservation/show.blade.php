@extends('base')

@section('title', $reservation->date)
@section('description', $reservation->seats)

@section('content')
    <h1>{{ $reservation->date }}</h1>
    {!! $reservation->seats !!}
@endsection
