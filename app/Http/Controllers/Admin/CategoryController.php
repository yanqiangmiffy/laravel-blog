<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
    //get admin/category  分类列表
    public function index()
    {
        //$category=Category::all();
        //$data=$this->getTree($category,'cate_name','cate_id','cate_pid');
        $data = (new Category)->tree();
        //dd($data);
        return view('admin.category.index')->with('data', $data);

    }

    public function changeOrder()
    {
        $input=Input::all();
        $category=Category::find($input['cate_id']);
        $category->cate_order=$input['cate_order'];
        $re=$category->update();
        if($re){
            $data=[
                'status' => 0,
                'msg' => '分类排序更改成功'
            ];
        }else{
            $data=[
                'status' => 1,
                'msg' => '分类排序更改失败'
            ];
        }
        return $data;
    }


    //get admin/category/create  创建分类
    public function create()
    {
        $data=Category::where('cate_pid',0)->get();
        return view('admin.category.add',compact('data'));
    }

    //post admin/category 添加分类提交
    public function store()
    {
        if($input=Input::except('_token')){
            $rules=[
                'cate_name'=>'required',
            ];
            $message=[
                'cate_name.required'=>'分类名称不能为空!',
            ];
            $validator=Validator::make($input,$rules,$message);
            if($validator->passes()){
                $re=Category::create($input);
                if($re){
                    return redirect('admin/category');
                }else{
                    return back()->with('errors','添加分类失败');
                }
            }else{
                return back()->withErrors($validator);
            }
        }else{
            return view('admin.category.add');
        }
    }

    //get admin/category/{category}/edit 编辑分类信息
    public function edit($cate_id)
    {
        $data=Category::find($cate_id);
        $p_cate=Category::where('cate_pid',0)->get();
        return view('admin.category.edit',compact('data','p_cate'));
    }

    //put admin/category/{category}  更新单个分类信息
    public function update($cate_id)
    {
        $input=Input::except('_token','_method');
        $re=Category::where('cate_id',$cate_id)->update($input);
        if($re){
            return redirect('admin/category');
        }else{
            return back()->with('errors','分类信息更新失败，请稍后重试');
        }
    }

    //get  admin/category/{category}  显示单个分类信息
    public function show()
    {

    }



    //delete admin/category/{category}  删除分类信息
    public function destroy($cate_id)
    {
        $re=Category::where('cate_id',$cate_id)->delete();
        Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
        if($re){
           $data=[
               'status' => 0,
               'msg' => '分类信息删除成功'
           ];
        }else{
            $data=[
                'status' => 1,
                'msg' => '分类信息删除失败'
            ];
        }
        return $data;
    }


}
