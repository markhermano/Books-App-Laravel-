@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <h6>Add/Remove Reader</h6>
    <h2>{{$book->title}}</h2>
    <h4>Current Readers</h4>
    <ul class="list-group">
        {{-- @foreach($currentReaders as $currentReader)
        <li class="list-group-item">{{$currentReader->name}}</li>
        @endforeach --}}
        {!! Form::open(['action' => 'BooksController@removeReaders', 'method' => 'DELETE',
        'enctype'=>'multipart/form-data']) !!}
        {{Form::hidden('_method','DELETE')}}
        <ul class="list-group">
            @foreach($currentReaders as $currentReader)
            <li class="list-group-item">
                <div class="custom-control custom-checkbox">
                    {{Form::checkbox('readers[]', $currentReader->id, false, ['class'=>'custom-control-input',
                    'id'=>'reader'.$currentReader->id])}}
                    {{Form::label('reader'.$currentReader->id, $currentReader->name,
                    ['class'=>'custom-control-label'])}}
                </div>
                {{Form::hidden('bookId', $book->id)}}
            </li>
            @endforeach
        </ul>
        <br>
        {{Form::submit('Remove Reader(s)', ['class'=>'btn btn-secondary'])}}
        {!! Form::close() !!}
    </ul>
    <br>
    <h4>Readers</h4>
    <div class="row">
        <div class="col">
            {!! Form::open(['action' => 'BooksController@addReaders', 'method' => 'POST',
            'enctype'=>'multipart/form-data']) !!}
            <ul class="list-group">
                @foreach($readersArray as $reader)
                <li class="list-group-item">
                    <div class="custom-control custom-checkbox">
                        {{Form::checkbox('readers[]', $reader->id, false, ['class'=>'custom-control-input',
                        'id'=>'reader'.$reader->id])}}
                        {{Form::label('reader'.$reader->id, $reader->name, ['class'=>'custom-control-label'])}}
                    </div>
                    {{Form::hidden('bookId', $book->id)}}
                </li>
                @endforeach
            </ul>
            <br>
            {{Form::submit('Add Reader(s)', ['class'=>'btn btn-secondary'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
