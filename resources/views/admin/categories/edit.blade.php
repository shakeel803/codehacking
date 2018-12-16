@extends('layouts.admin')

@section('title')
    Edit category
@endsection

@section('content')

    <h1>Edit category</h1>
    <div class="col-md-6">
        @include('includes.form_errors')
        {!! Form::model($cat, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update',$cat->id]]) !!}

            <div class="form-group">
                {!! Form::label('name','Name:') !!}
                {!! Form::text('name',null,['class'=>'form-control','tabindex'=>1]) !!}
            </div>

            <div class="form-group">
                    {!! Form::submit('Update category',['class'=>'btn btn-primary','tabindex'=>2]) !!}
            </div>

        {!! Form::close() !!}
    </div>
    
@endsection