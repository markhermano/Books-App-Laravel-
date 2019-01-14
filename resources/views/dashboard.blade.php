@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <h6>Dashboard</h6>
    <h2>{{$heading}}</h2>
    <div class="row">
        @foreach($books as $book)
        <div class="col-sm-6">
            <div class="card border-dark mb-3 ">
                <div class="card-body">
                    <span class="badge badge-pill badge-secondary">{{$book->id}}</span>
                    <h4 class="card-title">{{$book->title}}</h4>
                    <p>{{$book->description}}</p>
                    <p><i>{{$book->user->name}}</i></p>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
