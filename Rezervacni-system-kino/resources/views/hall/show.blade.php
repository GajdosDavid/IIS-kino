@extends('layouts.app')

@section('title', $hall->name)
@section('description', $hall->address)

@section('content')
    <h1>{{ $hall->name }}</h1>
    adresa: {!! $hall->address !!}<br>
    kapacita: {!! $hall->capacity !!}<br>
    řad: {!! $hall->rows !!}<br>
    sedadel v řadě: {!! $hall->seats_in_row !!}
@endsection
