@extends('base')

@section('title', $hall->name)
@section('description', $hall->address)

@section('content')
    <h1>{{ $hall->name }}</h1>
    {!! $hall->address !!}
@endsection
