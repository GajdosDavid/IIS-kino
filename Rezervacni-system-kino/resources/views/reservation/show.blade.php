@extends('layouts.app')

@section('title', "Detail rezervace")
@section('description', "Detail rezervace")

@section('content')
    <p>sedadla:{{ json_encode($reservation->seats) }}</p>
    <p>zaplaceno: {!! $reservation->is_paid !!}</p>

    @if($reservation->user)
        <p><a href="{{ route('user.show', ['user' => $reservation->user]) }}">Detail uživatele</a></p>
    @else
        <p>Údaje o neregistrovanem uživateli:
        <p>Jmeno: {{ $reservation->first_name.' '.$reservation->surname}}</p>
        <p>Telefon: {{ $reservation->phone}}</p>
        <p>Email: {{ $reservation->email}}</p>

    @endif
@endsection
