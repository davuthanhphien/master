<?php

    namespace App\Repositories\Menu;

    use App\Repositories\BaseRepository;
    use Illuminate\Database\Eloquent\Model;
    use App\Menu;
    use App\Repositories\Menu\MenuRepositoryInterface;

   class MenuRepository extends BaseRepository implements MenuRepositoryInterface {

        public function __construct(Menu $menu)
        {
            parent::__construct($menu);
        }
   }

