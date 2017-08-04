<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Links;
use App\Http\Model\Navs;

use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public  function __construct()
    {
        //点击量最高的6篇文章
        $hot=Article::orderBy('art_view','desc')->take(6)->get();

        //最新发布的文章8篇
        $new=Article::orderBy('art_time','desc')->take(8)->get();

        //友情链接
        $links=Links::orderBy('link_order','asc')->get();
        $navs=Navs::all();
        \View::share('hot',$hot);
        \View::share('new',$new);
        \View::share('links',$links);
        \View::share('navs',$navs);
    }
}
