<?php

namespace App\Http\Controllers;

use App\BestReply;
use App\Like;
use App\Ratting;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
    public function like($id){
      
        Like::create([
            'user_id' => Auth::id(),
            'reply_id' => $id,
        ]);

        
        return redirect()->back();
    }

    public function unLike($id){

        $like = Like::where(['reply_id' => $id,'user_id'=>Auth::id()])->first();
        $like->forceDelete();

        return redirect()->back();
    }

    public function ratting($id,$key_field){
        $user_id = Auth::id();
        $ratting = Ratting::where(['reply_id' => $id,'user_id'=>$user_id])->first();
        if($ratting){
            $ratting->forceDelete();
        }

        Ratting::create(
            [
                'reply_id' => $id,
                'user_id' => $user_id,
                $key_field => 1
            ]
        );

        return redirect()->back();
    }

    public function bestReply($reply_id,$user_id,$discussion_id){
      
        // dd($user_id);
        $best_reply = BestReply::create([
            'reply_id' => $reply_id,
            'discussion_id'=>$discussion_id,
            'user_id' => $user_id,
        ]);

        // dd( $best_reply->user->points);
        $best_reply->user->points += 100;
        $best_reply->user->save();
        
        return redirect()->back();
    }
}
