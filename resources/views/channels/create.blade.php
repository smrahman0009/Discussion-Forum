@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            {{isset($channel) ? "Create Channel" : "Edit Channel"}}
        </div>

        <div class="card-body">
            <form action="{{isset($channel) ? route('channels.update',$channel->id) : route('channels.store')}}" method="post">
                {{csrf_field()}}
                @if(isset($channel))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <input type="text" name ="title" class="form-control" value="{{isset($channel) ? $channel->title : ''}}">
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">
                        {{isset($channel) ? "Edit Channel" : "Create Channel"}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
