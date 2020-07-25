@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <span>{{$discussion->user->name}}</span>
        <br>
        <img src="{{asset($discussion->user->avatar)}}" alt="" width="70px" height="70px">&nbsp;&nbsp;&nbsp;
        <br>
        <b>{{$discussion->created_at->diffForHumans()}}</b>
    </div>

    <div class="card-body">
        <h3 class="text-center">
            {{$discussion->title}}
        </h3>
        <hr>
        <p class="text-center">
        {{$discussion->content}}
        </p>
    </div>
    <div class="card-footer">
        <p>
            {{$discussion->replies->count() ? $discussion->replies->count() : ""}}
                {{$discussion->replies->count() > 1 ? "Replies":"Reply"}}
        </p>
    </div>
</div>
<br>
@foreach($discussion->replies as $reply)
<div class="card">
    <div class="card-header">
        <span>{{$reply->user->name}}</span>
        <br>
        <img src="{{asset($reply->user->avatar)}}" alt="" width="70px" height="70px">&nbsp;&nbsp;&nbsp;
        <br>
        <b>{{$reply->created_at->diffForHumans()}}</b>
    </div>

    <div class="card-body">
        <p class="text-center">
            {{$reply->content}}
        </p>
    </div>
    <div class="card-footer">
        @if($reply->is_liked_auth_user())
            <a href="{{route('reply.unlike',$reply->id)}}" class="btn btn-warning btn-sm">Unlike</a>
        @else
            <a href="{{route('reply.like',$reply->id)}}" class="btn btn-success btn-sm">Like</a>
        @endif
    </div>
</div>
<br>
@endforeach
<br>
<div class="card card-default">
    <div class="card-header">
        <h4 class="text-center">Leave a reply</h4>
    </div>
    <div class="card-body">
        <form action="{{route('discussion.reply',$discussion->id)}}" method="post">
            @csrf
            <div class="form-group">
                <textarea name="reply" id="reply" cols="30" rows="10" class="form-control">
                </textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>   
@endsection
