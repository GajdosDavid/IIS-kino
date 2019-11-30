@extends('layouts.app')

@section('title', 'Tvorba představení')
@section('description', 'Editor pro vytvoření nového představení.')

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        @if (Auth::user()->role == 3 || Auth::user()->role == 2 )
            <h1>Tvorba představení</h1>

            <form action="{{ route('performance.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="date">Datum ve formátu YYYY-MM-DD *</label>
                    <input type="text" name="date" id="date" class="form-control" value="{{ old('date') }}"/>
                </div>

                <div class="form-group">
                    <label for="beginning">Začátek ve formátu H:MM *</label>
                    <input type="text" name="beginning" id="beginning" class="form-control" value="{{ old('beginning') }}" />
                </div>

                <div class="form-group">
                    <label for="end">Konec ve formátu H:MM *</label>
                    <input type="text" name="end" id="end" class="form-control" value="{{ old('end') }}" />
                </div>

                <div class="form-group">
                    <label for="price">Cena *</label>
                    <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}" />
                </div>

                <div class="form-group">
                    <label for="piece">Kulturní dílo *</label>
                    <br>
                    @if($pieces->isEmpty())
                        <p style="color:#FF0000">Žádná kulturní díla ještě nebyla vytvořena!</p>
                    @else
                        <select name="piece" id="piece" class="form-control">
                        @foreach($pieces as $piece)
                            <option value="{{$piece->id}}">{{$piece->name}}</option>
                        @endforeach
                        </select>
                    @endif
                </div>

                <div class="form-group">
                    <label for="hall[]">Sály *</label>
                    <br>
                    @forelse ($halls as $hall)
                        <input type="checkbox" name="hall[]" id="hall[]" value="{{$hall->id}}">
                        <label for="hall[]">{{$hall->name}}</label><br>
                    @empty
                        <p style="color:#FF0000">Žádné sály ještě nebyly vytvořeny!</p>
                    @endforelse
                </div>

                <button type="submit" class="btn btn-primary">Vytvořit představení</button>
            </form>
        @else
            <h1>K této stránce nemáte přístup</h1>
        @endif
    @endguest
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('//cdn.tinymce.com/4/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#content',
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            entities: '160,nbsp',
            entity_encoding: 'raw'
        });
    </script>
@endpush
