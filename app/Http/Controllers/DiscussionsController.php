<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Discussion;
use App\Reply;
use App\User;
use App\Notifications\NewReplyAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
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
        $best_reply = $discussion->bestReply;
        return view('discussions.show')->with('discussion',$discussion)->with('best_reply',$best_reply);
    }

    public function reply(Request $request,$id){
        $discussion = Discussion::find($id)->first();
        $this->validate($request,['reply'=>'required']);
        $reply = Reply::create([
            'user_id' => Auth::id(),
            'discussion_id' => $discussion->id,
            'content' => $request->reply,
        ]);

        $reply->user->points += 20;
        $reply->user->save();
        
        $watchers = array();
        foreach($discussion->watchers as $watcher){
            array_push($watchers,User::find($watcher->user_id));
        }
       
        Notification::send($watchers, new NewReplyAdded($discussion));

        session()->flash('success','Reply submitted successfully');

        return redirect()->route('discussion',$discussion->slug);
    }

    public function edit($slug){
        $discussion = Discussion::where(['slug' => $slug])->first();
        return view('discussions.create')->with('discussion',$discussion);
    }

    public function update(Request $request,$id){
       
        $this->validate($request,['content'=>'required']);
        $discussion = Discussion::find($id);
        $discussion->content = $request->content;

        $discussion->save();

        return redirect()->route('discussion',$discussion->slug);

    }
}
