<?php

    namespace App\Repositories\Role;

    use App\Repositories\BaseRepository;
    use App\Role;
    use Illuminate\Database\Eloquent\Model;
    use App\Repositories\Role\RoleRepositoryInterface;

   class RoleRepository extends BaseRepository implements RoleRepositoryInterface{

        public function __construct(Role $role)
        {
            parent::__construct($role);
        }
       public function detach($id){
           return Role::findOrFail($id)->permission()->detach();
       }
       public function sync($id,$input){
           return Role::findOrFail($id)->permission()->sync($input);
       }
   }

