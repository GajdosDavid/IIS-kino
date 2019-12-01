@extends('layouts.app')

@section('title', $user->first_name)
@section('description', $user->surname)

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        @if (Auth::user()->id == $user->id || Auth::user()->role == 3 || Auth::user()->role == 1)
            <h1>{{ $user->first_name.' '.$user->surname}}</h1>
            <p>email: {!! $user->email !!}</p>
            <p>phone: {!! $user->phone !!}</p>
            <p>role: {!! $user->role !!}</p>
            <p>vytvořen: {!! $user->created_at !!}</p>
        @else
            <h1>K této stránce nemáte přístup</h1>
        @endif
    @endguest
@endsection
