<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface{

    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function getAll(){
        return $this->model->all();
    }

    public function getById($id){
        return $this->model->findOrFail($id);
    }

    public function create($data){
        return $this->model->create($data);
    }

    public function update($id, $data){
        return  $this->getById($id)->update($data);
    }

    public function delete($id){
        return $this->getById($id)->delete();
    }

    public function handleUploadedImage($image,$imageName){
        if (!is_null($image)) {
            $image->move('images',$imageName);
        }
    }
}

