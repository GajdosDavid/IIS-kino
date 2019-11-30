@extends('layouts.app')

@section('title', $piece->name)
@section('description', $piece->description)

@section('content')
    <h1>{{ $piece->name }}</h1>
    <br>
    <br>

    <img src="/storage/{{$piece->image}}" alt="$piece->name" height="500">
    <br><br>
    <p>typ: {!! $piece->type !!}</p>
    <p>popis: {!! $piece->description !!}</p>
    <p>žánr: {!! $piece->genre !!}</p>
    <p>účinkující: {!! $piece->performer !!}</p>

    @forelse($performances as $performance)
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
        @foreach($performance->halls as $hall)
                <tr>
                    <td>{{$hall->name}}</td>
                    <td>{{$performance->date}}</td>
                    <td>{{$performance->beginning}}</td>
                    <td>
                        <a href="{{ route('reservation.create') }}" >Rezervovat</a>
                    </td>
                </tr>
        @endforeach
            </tbody>
        </table>
    @empty
        <p>Nejsou žádná představení</p>
    @endforelse
    <br>
    <a href="{{ route('reservation.create') }}" class="btn btn-primary">
        Vytvořit rezervaci
    </a>
@endsection
