@extends('layouts.blog-post')

@section('title')
    {{ $post->title }}
@endsection

@section('content')

     <!-- Blog Post -->

                <!-- Title -->
                <h1>{{ $post->title }}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">{{ $post->user->name }}</a>
                </p>
                @include('includes.flash')
                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->created_at->format('D M y h:i:s a') }}</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="{{ $post->photo->file }}" alt="">

                <hr>
                <!-- Post Content -->
                <p>{{ $post->body }}</p>
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                @if (Auth::user())
                    <div class="well">
                        <h4>Leave a Comment:</h4>
                        {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="form-group">    
                                {!! Form::textarea('body', null,['class'=>'form-control', 'rows' => 3,'style'=>'resize:none;']) !!}
                            </div>
                            {!! Form::submit('Submit comment',['class'=>'btn btn-primary','rows'=>2]) !!}
                        {!! Form::close() !!}
                    </div>

                    <hr>   
                @endif
                

                <!-- Posted Comments -->
                @if (count($comments)>0)
                    @foreach ($comments as $cmt)
                        <!-- Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" width="64"  src="{{ $cmt->photo }}" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{ $cmt->author }}
                                    <small>{{ $cmt->created_at->format('M d, Y')." at ".$cmt->created_at->format('h:i A') }}</small>
                                </h4>
                                {{ $cmt->body }}
                                
                                @if (count($cmt->replies)>0)
                                    @foreach ($cmt->replies as $reply)
                                        @if($reply->is_active)
                                        <!--Nested Comment Replies -->
                                        <div id="nested-comment" class="media">
                                            <a class="pull-left" href="#">
                                                <img width="64" class="media-object" src="{{ $reply->photo }}" alt="">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{ $reply->author }}
                                                        <small>{{ $reply->created_at->format('M d, Y')." at ".$reply->created_at->format('h:i A') }}</small>
                                                </h4>
                                                {{ $reply->body }}
                                            </div>
                                        </div>
                                        <!-- End Nested Comment -->
                                        @endif
                                    @endforeach
                                @endif
                                <div class="comment-reply-container mt-1">
                                    <button class="toggle-reply btn btn-primary btn-xs pull-right">Reply</button>
                                    <div class="comment-form col-sm-8">
                                        @include('includes.form_errors')
                                        {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}
                                            <input type="hidden" name="comment_id" value="{{ $cmt->id }}">
                                            <div class="form-group">
                                                {!! Form::textarea('body',null, ['class'=>'form-control','rows'=>2,'style'=>'resize:none;']) !!}
                                            </div>
                                            {!! Form::submit('Submit comment',['class'=>'btn btn-primary']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    @endforeach
                @else
                    {{ "No comments" }}
                @endif
                <!-- Comment -->
                {{-- <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                </div> --}}
    
@endsection

@section('scripts')

<script>
    $(".comment-reply-container .toggle-reply").click(function(){
        $(this).next().slideToggle("fast");
    });
</script>
    
@endsection