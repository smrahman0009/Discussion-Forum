<?php

namespace App\Http\Controllers;

use App\Like;
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
}
