@extends('layouts.admin')

@section('title')
    Manage users
@endsection

@section('content')

    <h1>Users</h1>
    @include('includes.flash')
    <table class="table table-striped table-responsive">
        <thead>
          <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
            @if ($users)
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><img src="{{ $user->photo ? $user->photo->file : 'https://via.placeholder.com/50' }}" class="img-responsive img-rounded"></td>
                        <td>
                            <a href="{{URL("admin/users/".$user->id."/edit") }}">{{ $user->name }}</a>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->is_active == 1 ? 'Active' : 'Not active' }}</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                        <td>
                            {!! Form::open(['method'=>'DELETE','action'=>['AdminUsersController@destroy',$user->id]]) !!}
                            {!! Form::submit('Delete user', ['class'=>'btn btn-danger btn-xs','onClick'=>'return confirm(\'Are you sure to delete?\')']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            @endif
          
        </tbody>
      </table>
    
@endsection