<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function create($data);

    public function update($id, $data);

    public function delete($id);

    public function handleUploadedImage($image,$imageName);
}
