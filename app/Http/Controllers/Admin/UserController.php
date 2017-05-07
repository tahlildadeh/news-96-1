<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        dd('salam', func_get_args()) ;
    }

    public function user($id = 905)
    {
//    if(!preg_match('/^[1-9][0-9]*$/', $id)){
//        abort(404);
//    }
        dd (__FILE__,__LINE__, $id);
    }
}
