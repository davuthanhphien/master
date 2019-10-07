<?php

namespace App\Repositories\Role;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Role;

interface RoleRepositoryInterface extends BaseRepositoryInterface {
    public function detach($id);
    public function sync($id,$input);
}
