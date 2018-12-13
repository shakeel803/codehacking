@extends('layouts.admin')

@section('title')
    Manage users
@endsection

@section('content')

    <h1>Users</h1>
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
          </tr>
        </thead>
        <tbody>
            @if ($users)
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            @if ($user->photo)
                                <img height="50" class="img-rounded" src="{{ $user->photo->file }}">
                            @else
                                <img height="50" class="img-rounded" src="{{ "/images/no-image.jpg" }}">
                            @endif
                        </td>
                        <td><a href="{{URL("admin/users/".$user->id."/edit") }}">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->is_active == 1 ? 'Active' : 'Not active' }}</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            @endif
          
        </tbody>
      </table>
    
@endsection