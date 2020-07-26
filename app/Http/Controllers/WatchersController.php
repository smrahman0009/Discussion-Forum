<?php

namespace App\Http\Controllers;

use App\Watcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchersController extends Controller
{
    public function watch($id){
        Watcher::create([
            'discussion_id' => $id,
            'user_id' => Auth::id(),
        ]);

        session()->flash("This discussion add to your watch list");

        return redirect()->back();
    }

    public function unWatch($id){
        $watcher = Watcher::where(['discussion_id'=>$id,'user_id'=>Auth::id()])->first();
        $watcher->forceDelete();

        session()->flash("This discussion remove from your watch list");

        return redirect()->back();
    }
}
