<?php
/**
 * Created by PhpStorm.
 * User: Nguyen The Anh
 * Date: 30/01/2019
 * Time: 11:30
 */

namespace App;


trait UserAccess
{
    public function hasPermisstion ($name)
    {
        $roles = $this->role;
        foreach ($roles as $role){
            if ($role->full == '1'){
                return true;
            }
            foreach ($role->permission as $item){
                if ($item->name == $name){
                    return true;
                }
            }
        }

        return false;
    }
}
