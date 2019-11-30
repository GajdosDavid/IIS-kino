@extends('layouts.app')

@section('title', $reservation->date)
@section('description', $reservation->seats)

@section('content')
    <p>sedadla:{{ $reservation->seats }}</p>
    <p>zaplaceno: {!! $reservation->is_paid !!}</p>

    <p>Údaje o neregistrovanem uživateli:
    <p>Jmeno: {{ $reservation->first_name.' '.$reservation->surname}}</p>
    <p>Email: {{ $reservation->email}}</p>
@endsection
