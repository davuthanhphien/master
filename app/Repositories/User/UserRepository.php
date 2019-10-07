<?php

    namespace App\Repositories\User;

    use App\Repositories\BaseRepository;
    use App\User;
    use Illuminate\Database\Eloquent\Model;
    use App\Repositories\User\UserRepositoryInterface;

   class UserRepository extends BaseRepository implements UserRepositoryInterface{

        public function __construct(User $user)
        {
            parent::__construct($user);
        }
       public function detach($id){
           return User::findOrFail($id)->role()->detach();
       }
       public function sync($id,$input){
           return User::findOrFail($id)->role()->sync($input);
       }
   }

