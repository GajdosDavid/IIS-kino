@extends('layouts.app')

@section('title', "Detail rezervace")
@section('description', "Detail rezervace")

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        @if (Auth::user()->id == $reservation->user->id || Auth::user()->role == 3 || Auth::user()->role == 1)
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
        @else
            <h1>K této stránce nemáte přístup</h1>
        @endif
    @endguest
@endsection
