@extends('layouts.app')

@section('title', $performance->name)
@section('description', $performance->description)

@section('content')
    <div class="administration-form">
            <br>
        datum: {{ $performance->date }}<br>
        začátek: {!! $performance->beginning !!}<br>
        konec: {!! $performance->end !!}<br>
        cena: {!! $performance->price !!}<br>
        sály:<br>
        @foreach($performance->halls as $hall)
            {{$hall->name}}<br>
        @endforeach
    </div>
@endsection
