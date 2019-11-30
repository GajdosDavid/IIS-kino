@extends('layouts.app')

@section('title', $user->first_name)
@section('description', $user->surname)

@section('content')
    <h1>{{ $user->first_name.' '.$user->surname}}</h1>
    <p>email: {!! $user->email !!}</p>
    <p>phone: {!! $user->phone !!}</p>
    <p>role: {!! $user->role !!}</p>
@endsection
