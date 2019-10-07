<?php

    namespace App\Repositories\Permission;

    use App\Permission;
    use App\Repositories\BaseRepository;
    use Illuminate\Database\Eloquent\Model;
    use App\Repositories\Permission\PermissionRepositoryInterface;

   class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface{

        public function __construct(Permission $permission)
        {
            parent::__construct($permission);
        }
   }

