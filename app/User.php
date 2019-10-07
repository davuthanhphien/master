<?php

namespace App;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\InvoicePaid;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use UserAccess;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password','online'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role(){
        return $this->belongsToMany('App\Role','role_users','user_id','role_id');
    }
    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function room(){
        return $this->belongsToMany('App\Room','room_user','user_id','room_id');
    }

    public function friends()
    {
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id');
    }

    public function friend(){
        return $this->belongsToMany('App\User','friends','user_id','friend_id');
    }

    public function notification(){
        return $this->hasMany('App\Notification','user_id');
    }

}
