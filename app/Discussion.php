<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Discussion extends Model
{
    protected $fillable = ['title','content','user_id','channel_id','slug'];

    public function channel(){
        return $this->belongsTo(Channel::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function watchers(){
        return $this->hasMany(Watcher::class);
    }

    public function is_in_watched_list(){
        $id = Auth::id();

        $discussions = array();
        foreach($this->watchers as $watcher){
            array_push($discussions,$watcher->user_id);
        }
     
        if(in_array($id,$discussions)){
            return true;
        }else return false;
    }

    public function bestReply(){
        return $this->hasOne(BestReply::class);
    }
    
}
