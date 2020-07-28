<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BestReply extends Model
{
    protected $fillable = ['reply_id','user_id','discussion_id'];

    public function discussion(){
        return $this->belongsTo(Discussion::class);
    }

    public function reply(){
        return $this->belongsTo(Reply::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
