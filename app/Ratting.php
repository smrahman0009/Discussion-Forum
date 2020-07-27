<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ratting extends Model
{
    protected $fillable = ['reply_id','user_id','up_vote','down_vote'];

    public function reply(){
        return $this->belongsTo(Reply::class);
    }

}
