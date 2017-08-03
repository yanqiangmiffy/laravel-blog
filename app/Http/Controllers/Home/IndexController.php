<?php

namespace App\Http\Controllers\Home;


use App\Http\Model\Article;
use App\Http\Model\Links;

class IndexController extends CommonController
{
    public function index()
    {
        //点击量最高的6篇文章
        $hot=Article::orderBy('art_view','desc')->take(6)->get();

        //最新发布的文章8篇
        $new=Article::orderBy('art_time','desc')->take(8)->get();

        //图文列表(带分页)
        $data=Article::orderBy('art_time','desc')->paginate(3);
        //友情链接
        $links=Links::orderBy('link_order','asc')->get();

        //网站配置项
        return view('home.index',compact('hot','new','data','links'));

    }

    public function cate()
    {
        return view('home.list');
    }
    public function article()
    {
        return view('home.article');
    }
}
