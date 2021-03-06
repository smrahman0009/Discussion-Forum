@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <span>{{$discussion->user->name}}</span>
        <br>
        <img src="{{asset($discussion->user->avatar)}}" alt="" width="70px" height="70px">&nbsp;&nbsp;&nbsp;
        <br>
        <b>{{$discussion->user->points}}</b>
        @if(!$discussion->is_in_watched_list())
        <a href="{{route('watch.watch',$discussion->id)}}" class="btn btn-info btn-sm float-sm-right">watch</a>
        @else
        <a href="{{route('watch.unwatch',$discussion->id)}}" class="btn btn-info btn-sm float-sm-right">unwatch</a>
        @endif
        @if(!$discussion->hasBestReply() && Auth::id() == $discussion->user_id)
            <a href="{{route('discussion.edit',$discussion->slug)}}" class="btn btn-info btn-sm float-sm-right">edit</a>
        @endif
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
    @if($best_reply)
    <div class="card text-center">
        <div class="card-header">
            Best Answer
        </div>
        <div class="card-body">
            <p class="card-text">
               <h4>
               {{$best_reply->reply->content}}
               </h4>
            </p>
            <img src="{{$best_reply->discussion->user->avatar}}" width="40px" height="40px" ><br>
            <b>{{$best_reply->user->name}}</b>
        </div>
        <div class="card-footer text-muted">
               {{$best_reply->user->points}}
        </div>
    </div>
    @endif
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
        <b> {{$reply->user->points}}</b>
        @if(!$best_reply && Auth::id() == $discussion->user->id && $discussion->user->id != $reply->user->id)
        <a href="{{route('reply.best.retting',
        ['reply_id'=>$reply->id,'user_id'=>$reply->user_id,'discussion_id'=>$discussion->id])}}"
            class="btn btn-success btn-sm float-sm-right">
            Mark as best answer
        </a>
        @endif
    </div>

    <div class="card-body">
        <p class="text-center">
            {{$reply->content}}
        </p>
    </div>
    <div class="card-footer">
        <!-- @if($reply->is_liked_auth_user())
            <a href="{{route('reply.unlike',$reply->id)}}" class="btn btn-warning btn-sm">
                <span class="badge">{{$reply->likes->count()}}</span>
                Unlike
            </a>
        @else
            <a href="{{route('reply.like',$reply->id)}}" class="btn btn-success btn-sm">
                <span class="badge">{{$reply->likes->count()}}</span>
                Like
             </a>
        @endif
        <br>
        <hr> -->
        <a href="{{route('reply.ratting',['id'=>$reply->id,'vote'=>'down_vote'])}}"
            class="btn btn-warning btn-sm float-sm-right">
            Down Vote
            <span class="badge">{{$reply->vote_count("down_vote")}}</span>
        </a>
        &nbsp;&nbsp;&nbsp;
        <a href="{{route('reply.ratting',['id'=>$reply->id,'vote'=>'up_vote'])}}"
            class="btn btn-success btn-sm float-sm-left">
            Up Vote
            <span class="badge">{{$reply->vote_count("up_vote")}}</span>
        </a>
    </div>
</div>
<br>
@endforeach
@if(!$discussion->bestReply)
<br>
<div class="card card-default">
    <div class="card-header">
        <h4 class="text-center">Leave a reply</h4>
    </div>
    <div class="card-body">
        @if(Auth::check())
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
        @else
            <div class="text-center">
                <h2>
                    Sign in first to leave a reply
                </h2>
            </div>
        @endif
    </div>
</div>
@else
<div class="card card-default">
    <div class="card-header">
        <h4 class="text-center">This discussion is closed</h4>
    </div>
</div>
@endif
@endsection
