<?php

    namespace App\Repositories\Banner;

    use App\Repositories\BaseRepository;
    use Illuminate\Database\Eloquent\Model;
    use App\Banner;

   class BannerRepository extends BaseRepository implements BannerRepositoryInterface {

        public function __construct(Banner $banner)
        {
            parent::__construct($banner);
        }
   }

