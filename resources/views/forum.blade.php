@extends('layouts.app')

@section('content')
    @foreach($discussions as $discussion)
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
               <p class="text-center">
                {{Str::limit($discussion->content,150)}}
               </p>
                <a href="{{route('discussion',$discussion->slug)}}" class="btn btn-info pull-right">View</a>
            </div>
            <div class="card-footer">
                <p>
                    {{$discussion->replies->count() ? $discussion->replies->count() : ""}}
                     {{$discussion->replies->count() > 1 ? "Replies":"Reply"}}
                </p>
            </div>
        </div>
        <br>
        <br>
    @endforeach
    <div class="text-center">
        {{$discussions->links()}}
    </div>
@endsection
