<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class NavController extends CommonController
{
    //get admin/Navs  导航列表
    public function index()
    {
        $data = Navs::all();
        return view('admin.navs.index', compact('data'));

    }

    //更改导航排序
    public function changeOrder()
    {
        $input = Input::all();
        $nav = Navs::find($input['nav_id']);
        $nav->nav_order = $input['nav_order'];
        $re = $nav->update();
        if ($re) {
            $data = [
                'status' => 0,
                'msg' => '导航排序更改成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'msg' => '导航排序更改失败'
            ];
        }
        return $data;
    }

    //get admin/navs/create  创建导航
    public function create()
    {
        return view('admin.navs.add');
    }

    //post admin/navs 添加导航提交
    public function store()
    {


        $input = Input::except('_token');
        $rules = [
            'nav_name' => 'required',
            'nav_url' => 'required',
        ];
        $message = [
            'nav_name.required' => '导航名称不能为空!',
            'nav_url.required' => '导航url不能为空!',
        ];
        $validator =Validator::make($input, $rules, $message);
        if ($validator->passes()) {
            $re = Navs::create($input);
            if ($re) {
                return redirect('admin/navs');
            } else {
                return back()->with('errors', '添加导航失败');
            }
        }
        else {
            return back()->withErrors($validator);
        }
    }
    //get admin/navs/{nav}/edit 编辑导航信息
    public function edit($nav_id)
    {
        $data=Navs::find($nav_id);
        return view('admin.Navs.edit',compact('data'));
    }

    //put admin/navs/{nav}  更新单个导航信息
    public function update($nav_id)
    {
        $input=Input::except('_token','_method');
        $re=Navs::where('nav_id',$nav_id)->update($input);
        if($re){
            return redirect('admin/navs');
        }else{
            return back()->with('errors','导航信息更新失败，请稍后重试');
        }
    }

    //delete admin/navs/{nav}  删除导航信息
    public function destroy($nav_id)
    {
        $re=Navs::where('nav_id',$nav_id)->delete();
        if($re){
            $data=[
                'status' => 0,
                'msg' => '导航信息删除成功'
            ];
        }else{
            $data=[
                'status' => 1,
                'msg' => '导航信息删除失败'
            ];
        }
        return $data;
    }
}
