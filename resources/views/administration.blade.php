@extends('layouts.app')

@section('content')
<div class="container">
    <h6>Administration</h6>

    @include('components.alert')
    <p>
        <a class="text-light btn btn-secondary" data-toggle="modal" data-target="#addUserModal">Add User</a>
    </p>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">User Type</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
                <td>
                    <a id="deleteBtn" class="btn btn-outline-secondary" data-toggle="modal" data-target="#confirmDeleteModal"
                        data-itemid="{{$user->id}}" data-toDelete="user" data-username="{{$user->name}}">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['action' => 'UsersController@store', 'method' => 'POST',
            'enctype'=>'multipart/form-data']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {{Form::label('name', 'Full Name')}}
                    {{Form::text('name', '', ['class'=> 'form-control',
                    'placeholder' => 'Name of user'])}}
                </div>
                <div class="form-group">
                    {{Form::label('userType', 'User Type')}}
                    {{Form::select('userType', ['reader' => 'Reader', 'writer' => 'Writer'],
                    null,['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('email', 'Email')}}
                    {{Form::text('email', '', ['class'=> 'form-control',
                    'placeholder' => 'Email of user'])}}
                </div>
            </div>
            <div class="modal-footer">
                {{Form::submit('Add User', ['class'=>'btn btn-secondary'])}}
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
