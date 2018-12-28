@extends('layouts.admin')

@section('title')
    Manage Replies
@endsection

@section('content')
    <h1>Replies</h1>
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
            @if ($replies)
                @foreach ($replies as $reply)
                    <tr>
                        <td>{{ $reply->id }}</td>
                        <td>
                            <a target="_blank" href="{{URL("/post/".$reply->comment->post_id) }}">View</a>
                        </td>
                        <td>{{ $reply->author }}</td>
                        <td>{{ $reply->email }}</td>
                        <td>{{ $reply->body }}</td>
                        <td>
                            @if ($reply->is_active == 0)
                                {!! Form::open(['method'=>'PATCH','action'=>['CommentRepliesController@update',$reply->id]]) !!}
                                    <input type="hidden" name="is_active" value="1">
                                    {!! Form::submit('Approve', ['class'=>'btn btn-success btn-xs']) !!}
                                {!! Form::close() !!}
                            @else 
                                {!! Form::open(['method'=>'PATCH','action'=>['CommentRepliesController@update',$reply->id]]) !!}
                                    <input type="hidden" name="is_active" value="0">
                                    {!! Form::submit('Unapprove', ['class'=>'btn btn-warning btn-xs']) !!}
                                {!! Form::close() !!} 
                            @endif
                           
                        </td>
                        <td>   
                            {!! Form::open(['method'=>'DELETE','action'=>['CommentRepliesController@destroy',$reply->id]]) !!}
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-xs','onClick'=>'return confirm(\'Are you sure to delete?\')']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            @endif
          
        </tbody>
      </table>
@endsection