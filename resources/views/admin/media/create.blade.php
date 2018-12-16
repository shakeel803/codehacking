@extends('layouts.admin')

@section('title')
    Upload media
@endsection

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
    
@endsection

@section('content')

    <h1>Upload media</h1>
    @include('includes.form_errors')
    {!! Form::open(['method'=>'POST', 'files'=>true, 'action'=>'AdminMediasController@store','class'=>'dropzone']) !!}
        

    {!! Form::close() !!}
    
@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script>
       $(document).ready(function(){
        Dropzone.options.fileupload = {
            maxFilesize: 50,
            init: function () {
                thisDropzone = this;
                this.on("error", function (file, responseText) {
                    $.each(responseText, function (index, value) {
                        $('.dz-error-message').text(value);
                    });
                });
            }
        };
       });
        
    </script>
    
@endsection