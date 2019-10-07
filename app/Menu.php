<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'id','name_vi','order_no','location','parent_id','url'
    ];

    public function childs()
    {
        return $this->hasMany($this, 'parent_id', 'id')->orderBy('order_no', 'asc');
    }
}
