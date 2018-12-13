@extends('layouts.admin')

@section('title')
    Create new user
@endsection

@section('content')

    <h1>Create Users</h1>
    @include('includes.form_errors')
    {!! Form::open(['files'=>true, 'method'=>'POST', 'action'=>'AdminUsersController@store']) !!}

        <div class="form-group">
            {!! Form::label('name','Name:') !!}
            {!! Form::text('name',null,['class'=>'form-control','tabindex'=>1]) !!}
        </div>

        <div class="form-group">
                {!! Form::label('email','Email:') !!}
                {!! Form::email('email',null,['class'=>'form-control','tabindex'=>2]) !!}
        </div>

        <div class="form-group">
                {!! Form::label('is_active','Status:') !!}
                {!! Form::select('is_active', array(1=>'Active', 0=>'Not Active'), 0, ['class'=>'form-control','tabindex'=>3]) !!}
        </div>


        <div class="form-group">
                {!! Form::label('role_id','Role:') !!}
                {!! Form::select('role_id',[''=>'Choose Role'] + $roles, null,['class'=>'form-control','tabindex'=>4]) !!}
        </div>

        <div class="form-group">
                {!! Form::label('photo_id','Profile picture:') !!}
            {!! Form::file('photo_id',null, ['class'=>'form-control','tabindex'=>5]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password','Password:') !!}
            {!! Form::password('password',['class'=>'form-control','tabindex'=>6]) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create User',['class'=>'btn btn-primary','tabindex'=>7]) !!}
        </div>

    {!! Form::close() !!}
    
@endsection