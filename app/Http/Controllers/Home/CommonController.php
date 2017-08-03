<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public  function __construct()
    {
        $data=Navs::all();
        \View::share('data',$data);
    }
}
