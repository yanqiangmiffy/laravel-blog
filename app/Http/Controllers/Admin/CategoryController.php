<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends CommonController
{
    //get admin/category  分类列表
    public function index()
    {
        $category=Category::all();
        return view('admin.category.index')->with('data',$category);

    }
    //post admin/category
    public function store()
    {

    } //get admin/category/create  创建分类
    public function create()
    {

    }
    //get  admin/category/{category}  显示单个分类信息
    public function show()
    {

    }
    //put admin/category/{category}  更新单个分类信息
    public function update()
    {

    }
    //delete admin/category/{category}  删除分类信息
    public function destroy()
    {

    }
    //get admin/category/{category}/edit 编辑分类信息
    public function edit()
    {

    }
}
