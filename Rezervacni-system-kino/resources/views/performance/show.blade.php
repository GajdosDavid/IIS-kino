@extends('base')

@section('title', $performance->name)
@section('description', $performance->description)

@section('content')
    <h1>{{ $performance->name }}</h1>
    <br>

    <img src="/storage/{{$performance->image}}" alt="$performance->name" height="500">
    <br>
    <p>{!! $performance->description !!}</p>
@endsection
