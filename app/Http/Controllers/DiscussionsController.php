<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Discussion;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DiscussionsController extends Controller
{
    public function create(){
        return view('discussions.create')->with('channels',Channel::all());
    }

    public function store(Request $request){
        // dd($request->all());

        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
            'channel_id' => 'required'
        ]);

        $discussion = Discussion::create([
            'title' => $request->title,
            'content' => $request->content,
            'channel_id' => $request->channel_id,
            'user_id' => Auth::id(),
            'slug' => Str::slug($request->title,'-'),
        ]);

        session()->flash('success','New discussion is created successfully');

        return redirect()->route('discussion',$discussion->slug);
    }

    public function show($slug){
        $discussion = Discussion::where(['slug'=>$slug])->first();
        // dd($discussion);
        return view('discussions.show')->with('discussion',$discussion);
    }

    public function reply(Request $request,$id){
        $discussion = Discussion::find($id)->first();
        $this->validate($request,['reply'=>'required']);
        Reply::create([
            'user_id' => Auth::id(),
            'discussion_id' => $discussion->id,
            'content' => $request->reply,
        ]);
        session()->flash('success','Reply submitted successfully');

        return redirect()->route('discussion',$discussion->slug);
    }
}
