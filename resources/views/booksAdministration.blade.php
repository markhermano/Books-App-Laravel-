@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Books Administration</h2>
    @include('components.alert')
    <p>
        <a class="text-light btn btn-secondary" data-toggle="modal" data-target="#addBookModal">Add Book</a>
    </p>

    @foreach($myBooks as $myBook)
    <div class="card border-secondary mb-3">
        <div class="card-body text-secondary">
            <span class="badge badge-pill badge-secondary">{{$myBook['book']->id}}</span>
            <h2 class="card-title text-dark">{{$myBook['book']->title}}</h2>
            <h6><i>{{$myBook['book']->created_at->format('M. d, Y')}}</i></h6>
            <p class="card-text">{{$myBook['book']->description}}</p>
            <a class="btn btn-secondary readerCollapseBtn" data-toggle="collapse" href="#readerCollapse{{$myBook['book']->id}}"
                role="button" aria-expanded="false" aria-controls="readerCollapse">Show
                Reader(s)</a>
            <a id="deleteBtn" class="btn btn-outline-danger" data-toggle="modal" data-target="#confirmDeleteModal"
                data-itemid="{{$myBook['book']->id}}" data-todelete="book" data-bookname="{{$myBook['book']->name}}">Delete</a>
            <div class="row">
                <div class="col">
                    <div class="collapse multi-collapse" id="readerCollapse{{$myBook['book']->id}}" data-bookid="{{$myBook['book']->id}}">
                        <br />
                        <ul class="list-group">
                            @if(count($myBook['readers']) > 0)
                            @foreach($myBook['readers'] as $reader)
                            <li class="list-group-item">
                                {{$reader->name}}
                            </li>
                            @endforeach
                            @else
                            <li class="list-group-item">No reader(s)</li>
                            @endif
                        </ul>
                        <br />
                        <a class="btn btn-outline-secondary" href="/booksAdministration/editReaderIndex/{{$myBook['book']->id}}">Edit
                            Reader(s)</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>

<!-- Add Book Modal -->
<div class="modal fade" id="addBookModal" tabindex="-1" role="dialog" aria-labelledby="addBookModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBookModalLabel">Add New Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['action' => 'BooksController@store', 'method' => 'POST',
            'enctype'=>'multipart/form-data']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {{Form::label('title', 'Title')}}
                    {{Form::text('title', '', ['class'=> 'form-control',
                    'placeholder' => 'Title of Book'])}}
                </div>
                <div class="form-group">
                    {{Form::label('description', 'Description')}}
                    {{Form::textarea('description', '', ['class'=> 'form-control',
                    'placeholder' => 'Book description'])}}
                </div>
            </div>
            <div class="modal-footer">
                {{Form::submit('Add Book', ['class'=>'btn btn-secondary'])}}
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!-- Modal Confirm Delete-->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Deleting User Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong></strong>'s account?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="delUser btn btn-danger" data-dismiss="modal">Delete</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
