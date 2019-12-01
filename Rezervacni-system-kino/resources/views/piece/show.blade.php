@extends('layouts.app')

@section('title', $piece->name)
@section('description', $piece->description)

@section('content')
    <h1>{{ $piece->name }}</h1>
    <br>
    <br>

    <img src="{{asset('img/'.$piece->image)}}" alt="$piece->name" height="500">
    <br><br>
    <p>typ: {!! $piece->type !!}</p>
    <p>popis: {!! $piece->description !!}</p>
    <p>žánr: {!! $piece->genre !!}</p>
    <p>účinkující: {!! $piece->performer !!}</p>

    @if($performances->isEmpty())
        <p>Pro toto kulturní dílo není žádná událost.</p>
    @else
        <table class="table table-striped table-bordered table-responsive-md">
            <thead>
            <tr>
                <th>Jméno sálu</th>
                <th>Datum</th>
                <th>Začátek</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
        @foreach($performances as $performance)
            @foreach($performance->halls as $hall)
                    <tr>
                        <td>{{$hall->name}}</td>
                        <td>{{$performance->date}}</td>
                        <td>{{$performance->beginning}}</td>
                        <td>
                            <a href="{{ route('reservation.createOnPerformance', [$performance->id, $hall->id]) }}" >Rezervovat</a>
                        </td>
                    </tr>
            @endforeach
        @endforeach
            </tbody>
        </table>
    @endif
@endsection
