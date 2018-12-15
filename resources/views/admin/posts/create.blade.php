@extends('layouts.admin')

@section('title')
    Create new post
@endsection

@section('content')

    <h1>Create post</h1>
    @include('includes.form_errors')
    {!! Form::open(['files'=>true, 'method'=>'POST', 'action'=>'AdminPostsController@store']) !!}

        <div class="form-group">
            {!! Form::label('title','Title:') !!}
            {!! Form::text('title',null,['class'=>'form-control','tabindex'=>1]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('category_id','Category:') !!}
            {!! Form::select('category_id', array(1=>'Active', 0=>'Not Active'), 0, ['class'=>'form-control','tabindex'=>2]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id','Featured photo:') !!}
            {!! Form::file('photo_id',['class'=>'form-control','tabindex'=>3]) !!}
        </div>

        <div class="form-group">
                {!! Form::label('body','Body:') !!}
                {!! Form::textarea('body',null,['class'=>'form-control','tabindex'=>2,'rows'=>6]) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create post',['class'=>'btn btn-primary','tabindex'=>7]) !!}
        </div>

    {!! Form::close() !!}
    
@endsection