<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public  function getUpload(){
        return view('admin.upload.index');
    }

    public function uploadFile(Request $request){
       if ($request->image !== null){
           foreach ($request->image as $image){
               $image->store('images');
           }
       }
    }
}
