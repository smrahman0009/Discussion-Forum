@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card card-header">
            <div class="d-flex justify-content-end mb-2">
                <a href="{{route('channels.create')}}" class="btn btn-success">Create Channel</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <th>
                        Name 
                    </th>
                    <th>
                        Edit
                    </th>
                    <th>
                        Delete
                    </th>
                </thead>
                <tbody>
                    @foreach($channels as $channel)
                        <tr>
                            <td>
                                {{ $channel->title}}
                            </td>
                            <td>
                                <a href="{{route('channels.edit',$channel->id)}}" class="btn btn-sm btn-info">Edit</a>
                            </td>
                            <td>
                                <form action="{{route('channels.destroy',$channel->id)}}" method="POST">
                                    @csrf 
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Destroy
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
