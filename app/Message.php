<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = [
        'message','user_id','room','image','link','status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
