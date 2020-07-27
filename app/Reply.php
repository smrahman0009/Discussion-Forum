<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reply extends Model
{
    protected $fillable = ['content','user_id','discussion_id'];

    public function discussion(){
        return $this->belongsTo(Discussion::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function is_liked_auth_user(){
        $id = Auth::id();

        $likers = array();
        foreach($this->likes as $like){
            array_push($likers,$like->user_id);
        }
     
        if(in_array($id,$likers)){
            return true;
        }else return false;
    }

    public function rattings(){
        return $this->hasMany(Ratting::class);
    }

    public function vote_count($key_field){
     
        $counter = 0;
        foreach($this->rattings as $ratting){
            if($key_field == "up_vote" && $ratting->up_vote){
                $counter++;
            }elseif($key_field == "down_vote" && $ratting->up_vote){
                $counter++;
            }
        }
        
        return $counter;
    }
}
