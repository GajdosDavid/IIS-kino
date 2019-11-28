@extends('base')

@section('title', $user->name)
@section('description', $user->surname)

@section('content')
    <h1>{{ $user->name }}</h1>
    {!! $user->surname !!}
@endsection
