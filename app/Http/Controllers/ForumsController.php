<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Discussion;
use Illuminate\Http\Request;

class ForumsController extends Controller
{
    public function index(){
        $discussions = Discussion::orderBy('created_at','desc')->paginate(3);

        return view('forum',['discussions'=>$discussions]);
    }

    public function channel($slug){
        $channel = Channel::where('slug',$slug)->orderBy('created_at','desc')->first();
        // dd($channel->discussions());
        return view('channel')->with('discussions',$channel->discussions()->paginate(3));
    }
}
