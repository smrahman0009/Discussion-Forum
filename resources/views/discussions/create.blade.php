@extends('layouts.app');

@section('content')
<div class="card card-default">
    <div class="card-header">
           {{isset($discussion) ? 'Edit discussion' : 'Create discussion'}}
    </div>
    <form action="{{ isset($discussion)?route('discussion.update',$discussion->id) : route('discussion.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if(isset($discussion))
            @method('PUT')
        @endif
        <div class="card-body">
            <div class="form-group">
                <label for="channel">Select a channel</label>
                <select name="channel_id" id="channel" class="form-control ">
                    @foreach($channels as $channel)
                        <option value="{{$channel->id}}"
                           @if(isset($discussion))
                                @if($channel->id === $discussion->channel_id)
                                    selected
                                @endif  
                           @endif 
                        >
                        {{$channel->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{isset($discussion) ? $discussion->title : ''}}{{old('title')}}">
            </div>
            <div class="form-group">
                <label for="content">Ask a question</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control">
                    {{isset($discussion) ? $channel->description:''}}
                    {{old('content')}}
                </textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                   {{isset($discussion) ? "Edit discussion" : "Create discussion"}}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection