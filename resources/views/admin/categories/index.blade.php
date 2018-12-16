@extends('layouts.admin')

@section('title')
    Manage categories
@endsection

@section('content')

    <h1>Categories</h1>
    @include('includes.flash')
    <div class="col-md-6">
        @include('includes.form_errors')
        {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}
        
            <div class="form-group">
                {!! Form::label('name','Name:') !!}
                {!! Form::text('name',null,['class'=>'form-control','tabindex'=>1]) !!}
            </div>
        
            <div class="form-group">
                {!! Form::submit('Create category',['class'=>'btn btn-primary','tabindex'=>2]) !!}
            </div>
        
        {!! Form::close() !!}
    </div>
    <div class="col-md-6">
        
        <table class="table table-striped table-responsive">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @if ($categories)
                    @foreach ($categories as $cat)
                        <tr>
                            <td>{{ $cat->id }}</td>
                            <td>
                                <a href="{{URL("admin/categories/".$cat->id."/edit") }}">{{ $cat->name }}</a>
                            </td>
                            <td>{{ $cat->created_at->diffForHumans() }}</td>
                            <td>{{ $cat->updated_at->diffForHumans() }}</td>
                            <td>
                                {!! Form::open(['method'=>'DELETE','action'=>['AdminCategoriesController@destroy',$cat->id]]) !!}
                                {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-xs','onClick'=>'return confirm(\'Are you sure to delete?\')']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                @endif
            
            </tbody>
        </table>
    </div>
    
@endsection