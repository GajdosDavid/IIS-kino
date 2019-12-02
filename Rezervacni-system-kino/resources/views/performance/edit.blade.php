@extends('layouts.app')

@section('title', 'Editace události ' . $performance->piece->name)
@section('description', 'Editor pro editaci události.')

@section('content')
    @guest
        <h1>K této stránce nemáte přístup</h1>
    @else
        @if (Auth::user()->role == 3 || Auth::user()->role == 2 )
            <h1>Editace události {{ $performance->piece->name }}</h1>

            <form action="{{ route('performance.update', ['performance' => $performance]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="date">Datum ve formátu YYYY-MM-DD *</label>
                    <input type="text" name="date" id="date" class="form-control" value="{{ old('date') ?: $performance->date }}"/>
                </div>

                <div class="form-group">
                    <label for="beginning">Začátek ve formátu H:MM *</label>
                    <input type="text" name="beginning" id="beginning" class="form-control" value="{{ old('beginning') ?: date('G:i', strtotime($performance->beginning)) }}" />
                </div>

                <div class="form-group">
                    <label for="end">Konec ve formátu H:MM *</label>
                    <input type="text" name="end" id="end" class="form-control" value="{{ old('end') ?: date('G:i', strtotime($performance->end)) }}" />
                </div>

                <div class="form-group">
                    <label for="price">Cena *</label>
                    <input type="text" name="price" id="price" class="form-control" value="{{ old('price') ?: $performance->price }} " />
                </div>

                <div class="form-group">
                    <label for="piece">Kulturní dílo *</label>
                    <br>
                    <select name="piece" id="piece" class="form-control">
                        @forelse ($pieces as $piece)
                            <option value="{{$piece->id}}" {{ ($piece->id == $performance->piece->id) ? "selected" : ""}}>{{$piece->name}}</option>
                        @empty
                            <option> Žádná kulturní díla ještě nebyla vytvořena!</option>
                        @endforelse
                    </select>
                </div>

                <div class="form-group">
                    <label for="hall[]">Sály *</label>
                    <br>
                    @forelse ($halls as $hall)
                        <input type="checkbox" name="hall[]" id="hall[{{$hall->id}}]" value="{{$hall->id}}" {{ $performance->halls->contains('id', $hall->id) ? 'checked' : '' }}>
                        <label for="hall[{{$hall->id}}]">{{$hall->name}}</label><br>
                    @empty
                        <p style="color:#FF0000">Žádné sály ještě nebyly vytvořeny!</p>
                    @endforelse
                </div>

                <button type="submit" class="btn btn-primary">Uložit událost</button>
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
