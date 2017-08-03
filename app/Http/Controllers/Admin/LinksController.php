<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class LinksController extends CommonController
{
    //get admin/links  友情链接列表
    public function index()
    {
        $data = Links::all();
        return view('admin.links.index', compact('data'));

    }

    //更改友情链接排序
    public function changeOrder()
    {
        $input = Input::all();
        $link = Links::find($input['link_id']);
        $link->link_order = $input['link_order'];
        $re = $link->update();
        if ($re) {
            $data = [
                'status' => 0,
                'msg' => '分类排序更改成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'msg' => '分类排序更改失败'
            ];
        }
        return $data;
    }

    //get admin/links/create  创建分类
    public function create()
    {
        return view('admin.links.add');
    }

    //post admin/links 添加分类提交
    public function store()
    {


        $input = Input::except('_token');
        $rules = [
            'link_name' => 'required',
            'link_url' => 'required',
        ];
        $message = [
            'link_name.required' => '链接名称不能为空!',
            'link_url.required' => '链接url不能为空!',
        ];
        $validator = \Validator::make($input, $rules, $message);
        if ($validator->passes()) {
            $re = Links::create($input);
            if ($re) {
                return redirect('admin/links');
            } else {
                return back()->with('errors', '添加链接失败');
            }
        }
        else {
            return back()->withErrors($validator);
        }
    }
    //get admin/links/{link}/edit 编辑分类信息
    public function edit($link_id)
    {
        $data=Links::find($link_id);
        return view('admin.links.edit',compact('data'));
    }

    //put admin/links/{link}  更新单个分类信息
    public function update($link_id)
    {
        $input=Input::except('_token','_method');
        $re=Links::where('link_id',$link_id)->update($input);
        if($re){
            return redirect('admin/links');
        }else{
            return back()->with('errors','分类信息更新失败，请稍后重试');
        }
    }

    //delete admin/links/{link}  删除分类信息
    public function destroy($link_id)
    {
        $re=Links::where('link_id',$link_id)->delete();
        if($re){
            $data=[
                'status' => 0,
                'msg' => '链接信息删除成功'
            ];
        }else{
            $data=[
                'status' => 1,
                'msg' => '链接信息删除失败'
            ];
        }
        return $data;
    }
}
