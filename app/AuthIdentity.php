<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AuthIdentity extends Model
{
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'provider_user_id', 'provider','access_token'
    ];

    public function newUser($user_id,$provider_user_id,$provider,$access_token){
        DB::table('outh_identities')->insert([
            [
            'user_id' => $user_id,
            'provider_user_id'=>$provider_user_id,
            'provider'=>$provider,
            'access_token'=>$access_token,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]
        ]);
    }

    public function getUserId($user_id,$provider){
        return DB::table('outh_identities')->where(['provider_user_id'=>$user_id,'provider'=>$provider])->first();
    }
}
