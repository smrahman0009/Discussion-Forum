<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Discussion;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class ForumsController extends Controller
{
    public function index(){
      
        switch(request('filter')){
            case 'me':
                $discussions = Discussion::orderBy('created_at','desc')->where('user_id',Auth::id())->paginate(3);
            break;
            case 'closed':
                $discussions = array();
                foreach(Discussion::all() as $discussion){
                    // $discussion->hasBestReply();
                    if($discussion->hasBestReply()){
                        array_push($discussions,$discussion);
                    }
                }
                $discussions = new Paginator($discussions,3);
                // dd($discussions);
            break;
            default:
                $discussions = Discussion::orderBy('created_at','desc')->paginate(3);

        }

        return view('forum',['discussions'=>$discussions]);
    }

    public function channel($slug){
        $channel = Channel::where('slug',$slug)->orderBy('created_at','desc')->first();
        // dd($channel->discussions());
        return view('channel')->with('discussions',$channel->discussions()->paginate(3));
    }
}
