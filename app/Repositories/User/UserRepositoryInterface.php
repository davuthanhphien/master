<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\User;

interface UserRepositoryInterface extends BaseRepositoryInterface {
    public function detach($id);
    public function sync($id,$input);
}
