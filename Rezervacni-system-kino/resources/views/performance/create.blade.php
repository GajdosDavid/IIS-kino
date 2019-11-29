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
                    <label for="name">Název</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required minlength="1" maxlength="300" />
                </div>

                <div class="form-group">
                    <label for="date">Datum ve formátu YYYY-MM-DD</label>
                    <input type="text" name="date" id="date" class="form-control" value="{{ old('date') }}"/>
                </div>

                <div class="form-group">
                    <label for="beginning">Začátek</label>
                    <input type="text" name="beginning" id="beginning" class="form-control" value="{{ old('beginning') }}" />
                </div>

                <div class="form-group">
                    <label for="end">Konec</label>
                    <input type="text" name="end" id="end" class="form-control" value="{{ old('end') }}" />
                </div>

                <div class="form-group">
                    <label for="price">Cena</label>
                    <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}" />
                </div>

                <div class="form-group">
                    <label for="type">Druh</label>
                    <input type="text" name="type" id="type" class="form-control" value="{{ old('type') }}" required minlength="1" maxlength="50" />
                </div>

                <div class="form-group">
                    <label for="description">Popis</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="genre">Žánr</label>
                    <input type="text" name="genre" id="genre" class="form-control" value="{{ old('genre') }}" required minlength="1" maxlength="50" />
                </div>

                <div class="form-group">
                    <label for="performer">Účinkující</label>
                    <input type="text" name="performer" id="performer" class="form-control" value="{{ old('performer') }}" required minlength="1" maxlength="500" />
                </div>

                <div class="form-group">
                    <label for="image">Obrázek</label>
                    <input type="file" name="image" id="image" class="form-control" value="{{ old('image') }}" />
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
