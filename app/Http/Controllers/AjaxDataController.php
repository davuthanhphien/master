<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DataTables;

class AjaxDataController extends Controller
{
    function index(){
        return view('admin.user.ajaxdata');
    }
    function getdata(){
        $user = User::select('id','name','email','email_verified_at');
        return DataTables::of($user)
            ->addColumn('action', function($user){
                return view('admin.user.table.action', ['user' => $user])->render();
            })
            ->make(true);
    }
}
