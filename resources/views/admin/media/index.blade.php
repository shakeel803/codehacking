@extends('layouts.admin')

@section('title')
    Manage media
@endsection

@section('content')
    <h1>Manage Media</h1>
    @include('includes.flash')
    <div class="col-sm-5">
        @include('includes.form_errors')
        {!! Form::open(['method'=>'POST', 'files'=>true, 'action'=>'AdminMediasController@store']) !!}
            <div class="form-group">
                {!! Form::label('file','Image:') !!}
                {!! Form::file('file', ['class'=>'form-control', 'tabindex'=>1]) !!}
            </div>
        
            <div class="form-group">            
                {!! Form::submit('Upload', ['class'=>'btn btn-primary', 'tabindex'=>2]) !!}
            </div>
        
        {!! Form::close() !!}
    </div>
    <div class="col-sm-7">
        <table class="table table-striped table-responsive">
            <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @if ($photos)
                    @foreach ($photos as $photo)
                        <tr>
                            <td>{{ $photo->id }}</td>
                            <td><img src="{{ $photo->file }}" alt="" height="50" class="img-rounded"></td>
                            <td>{{ $photo->created_at->diffForHumans() }}</td>
                            <td>{{ $photo->updated_at->diffForHumans() }}</td>
                            <td>
                                {!! Form::open(['method'=>'DELETE','action'=>['AdminMediasController@destroy',$photo->id]]) !!}
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