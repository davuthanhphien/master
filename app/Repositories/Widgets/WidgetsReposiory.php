<?php

    namespace App\Repositories\Widgets;

    use App\Repositories\BaseRepository;
    use Illuminate\Database\Eloquent\Model;
    use App\Widgets;
    use App\Repositories\Widgets\WidgetsRepositoryInterface;

   class WidgetsReposiory extends BaseRepository implements WidgetsRepositoryInterface {

        public function __construct(Widgets $widgets)
        {
            parent::__construct($widgets);
        }
   }

