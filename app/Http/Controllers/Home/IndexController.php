<?php

namespace App\Http\Controllers\Home;


use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;

class IndexController extends CommonController
{
    public function index()
    {


        //图文列表(带分页)
        $data=Article::orderBy('art_time','desc')->paginate(3);


        //网站配置项
        return view('home.index',compact('data'));

    }

    public function cate($cate_id)
    {
        $field=Category::find($cate_id);
        //图文列表(带分页)
        $data=Article::where('cate_id',$cate_id)->orderBy('art_time','desc')->paginate(3);

        //查看次数自增
        Category::where('cate_id',$cate_id)->increment('cate_view');

        //读取当前子分类
        $submenu=Category::where('cate_pid',$cate_id)->get();
        return view('home.list',compact('field','data','submenu'));
    }
    public function article($art_id)
    {
        #文章信息
        $field=Article::Join('category','article.cate_id','=','category.cate_id')->where('art_id',$art_id)->first();
        #查看次数自增
        Article::where('art_id',$art_id)->increment('art_view');
        #上一篇、下一篇
        $article['pre']=Article::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        $article['next']=Article::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();
        #相关文章
        $data=Article::where('cate_id',$field->cate_id)->orderBy('art_id','desc')->take(6)->get();
        return view('home.article',compact('field','article','data'));
    }
}
