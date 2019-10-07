<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    protected $fillable = [
        'name','description'
    ];

    public function role(){
        return $this->belongsToMany('App\Role','permission_roles','permission_id','role_id');
    }
}
