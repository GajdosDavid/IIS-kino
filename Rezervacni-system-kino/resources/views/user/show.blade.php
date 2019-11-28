@extends('base')

@section('title', $user->firstName)
@section('description', $user->surname)

@section('content')
    <h1>{{ $user->firstName }}</h1>
    {!! $user->surname !!}
@endsection
