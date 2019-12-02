@extends('layouts.app')

@section('title', $hall->name)
@section('description', $hall->address)

@section('content')
    <div class="administration-form">
        <br>
        <h1>{{ $hall->name }}</h1>
        adresa: {!! $hall->address !!}<br>
        kapacita: {!! $hall->rows * $hall->seats_in_row !!}<br>
        řad: {!! $hall->rows !!}<br>
        sedadel v řadě: {!! $hall->seats_in_row !!}
    </div>
@endsection
