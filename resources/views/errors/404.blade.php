@extends('layouts.app')


@section('title')
    Page not found.    
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Resource not found</h1>
                <p>Please go back to <a href="{{url('/')}}">Home</a></p> 
            </div>
        </div>
    </div>
@endsection
