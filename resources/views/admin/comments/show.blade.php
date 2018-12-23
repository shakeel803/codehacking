@extends('layouts.admin')

@section('title')
    Manage comments
@endsection

@section('content')
    
    <h1>Comments on <small>{{ $post->title }}</small></h1>
    @if (count($comments)>0)
        @include('includes.flash')
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Post</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th>Approve</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                @if ($comments)
                    @foreach ($comments as $cmt)
                        <tr>
                            <td>{{ $cmt->id }}</td>
                            <td>
                                <a target="_blank" href="{{URL("/post/".$cmt->post->id) }}">View</a>
                            </td>
                            <td>{{ $cmt->author }}</td>
                            <td>{{ $cmt->email }}</td>
                            <td>{{ $cmt->body }}</td>
                            <td>
                                @if ($cmt->is_active == 0)
                                    {!! Form::open(['method'=>'PATCH','action'=>['PostCommentsController@update',$cmt->id]]) !!}
                                        <input type="hidden" name="is_active" value="1">
                                        {!! Form::submit('Approve', ['class'=>'btn btn-success btn-xs']) !!}
                                    {!! Form::close() !!}
                                @else 
                                    {!! Form::open(['method'=>'PATCH','action'=>['PostCommentsController@update',$cmt->id]]) !!}
                                        <input type="hidden" name="is_active" value="0">
                                        {!! Form::submit('Unapprove', ['class'=>'btn btn-warning btn-xs']) !!}
                                    {!! Form::close() !!} 
                                @endif
                            
                            </td>
                            <td>   
                                {!! Form::open(['method'=>'DELETE','action'=>['PostCommentsController@destroy',$cmt->id]]) !!}
                                {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-xs','onClick'=>'return confirm(\'Are you sure to delete?\')']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                @endif
            
            </tbody>
        </table>
       
    @else
        <h1 style="text-align:center;">No comments</h1>    
    @endif
@endsection