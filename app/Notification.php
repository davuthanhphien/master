<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Notification extends Model
{
    protected $table = 'notification';
    protected $fillable = [
        'name','amount','user_id','friend_id'
    ];
    public function user(){
        $this->belongsTo('App\User');
    }

    public function friend(){
        $this->belongsTo('App\Friend','friend_id');
    }
}
