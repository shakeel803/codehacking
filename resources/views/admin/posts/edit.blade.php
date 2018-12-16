@extends('layouts.admin')

@section('title')
    Edit post
@endsection

@section('content')

    <h1>Edit post</h1>
    <div class="col-sm-3">
        <img src="{{ $post->photo ? $post->photo->file : 'https://via.placeholder.com/150' }}" class="img-responsive img-rounded">
    </div>
    <div class="col-sm-9">
        @include('includes.form_errors')
        {!! Form::model($post, ['files'=>true, 'method'=>'PATCH', 'action'=>['AdminPostsController@update',$post->id]]) !!}

            <div class="form-group">
                {!! Form::label('title','Title:') !!}
                {!! Form::text('title',null,['class'=>'form-control','tabindex'=>1]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('category_id','Category:') !!}
                {!! Form::select('category_id',$categories, null, ['class'=>'form-control','tabindex'=>2]) !!}
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
                {!! Form::submit('Update post',['class'=>'btn btn-primary','tabindex'=>7]) !!}
            </div>
            
        {!! Form::close() !!}
    </div>
@endsection