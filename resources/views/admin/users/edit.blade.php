@extends('layouts.admin')

@section('title')
    Create new user
@endsection

@section('content')

    <h1>Edit User</h1>
    <div class="col-sm-3">
        @if ($user->photo)
            <img class="img-responsive img-circle" src="{{ $user->photo->file }}">
        @else
            <img class="img-responsive img-circle" src="{{ "/images/no-image.jpg" }}">
        @endif
    </div>
    <div class="col-sm-9">
        @include('includes.form_errors')
        {!! Form::model($user, ['files'=>true, 'method'=>'PATCH', 'action'=>['AdminUsersController@update',$user->id]]) !!}

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
                    {!! Form::select('is_active', array(1=>'Active', 0=>'Not Active'), null, ['class'=>'form-control','tabindex'=>3]) !!}
            </div>


            <div class="form-group">
                    {!! Form::label('role_id','Role:') !!}
                    {!! Form::select('role_id', $roles, null,['class'=>'form-control','tabindex'=>4]) !!}
            </div>

            <div class="form-group">
                    {!! Form::label('photo_id','Profile picture:') !!}
                {!! Form::file('photo_id', ['class'=>'form-control','tabindex'=>'5']) !!}
                
            </div>

            <div class="form-group">
                {!! Form::label('password','Password:') !!}
                {!! Form::password('password',['class'=>'form-control','tabindex'=>6]) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update User',['class'=>'btn btn-primary','tabindex'=>7]) !!}
            </div>

        {!! Form::close() !!}

    </div>
    
@endsection