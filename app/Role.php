<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name','full',
    ];

    public function user(){
        return $this->belongsToMany('App\User','role_users','role_id','user_id');
    }
    public function permission(){
        return $this->belongsToMany('App\Permission','permission_roles','role_id','permission_id');
    }
}
