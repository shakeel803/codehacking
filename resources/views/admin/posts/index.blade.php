@extends('layouts.admin')

@section('title')
    Manage posts
@endsection

@section('content')

    <h1>Posts</h1>
    @include('includes.flash')
    <table class="table table-striped table-responsive">
        <thead>
          <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Title</th>
            <th>Body</th>
            <th>Link</th>
            <th>Author</th>
            <th>Comments</th>
            <th>Category</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
            @if ($posts)
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                            @if ($post->photo)
                                <img src="{{ $post->photo->file }}" height="50">
                            @else
                                {{ "No image "}}
                            @endif
                        </td>
                        <td>
                            <a href="{{URL("admin/posts/".$post->id."/edit") }}">{{ $post->title }}</a>
                        </td>
                        <td>{{ str_limit($post->body,15) }}</td>
                        <td><a href="/post/{{ $post->id }}" target="_blank">View</a></td>
                        <td>{{ $post->user->name }}</td>
                        <td><a href="{{ route('admin.comments.show',$post->id) }}">View</a></td>
                        <td>{{ $post->category ? $post->category->name : 'Uncategorized' }}</td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                        <td>
                            {!! Form::open(['method'=>'DELETE','action'=>['AdminPostsController@destroy',$post->id]]) !!}
                            {!! Form::submit('Delete post', ['class'=>'btn btn-danger btn-xs','onClick'=>'return confirm(\'Are you sure to delete?\')']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            @endif
          
        </tbody>
      </table>
      <div class="row">
          <div class="col-sm-6 col-sm-offset-5">
              {{ $posts->render() }}
          </div>
      </div>
    
@endsection