@extends('base')

@section('title', $performance->name)
@section('description', $performance->description)

@section('content')
    <h1>{{ $performance->name }}</h1>
    {!! $performance->description !!}
@endsection
