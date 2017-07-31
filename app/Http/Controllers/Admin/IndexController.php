<?php

namespace App\Http\Controllers\Admin;
use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    //
    public function index()
    {
        return view('admin.index');
    }

    //info页面
    public function info()
    {
        return view('admin.info');
    }
    //更改密码
    public function pass()
    {
        if($input=Input::all()){
            $rules=[
                'password'=>'required|between:6,20|confirmed',
            ];
            $message=[
                'password.required'=>'新密码不能为空!',
                'password.between'=>'新密码6-20位之间!',
                'password.confirmed'=>'新密码与确认密码不一致!',
            ];
            $validator=Validator::make($input,$rules,$message);
            if($validator->passes()){
                $user=User::first();
                $_password=Crypt::decrypt($user->user_pass);
                if($input['password_o']!=$_password){
                    return back()->with('errors','原密码错误');
                }else{
                    $user->user_pass=Crypt::encrypt($input['password']);
                    $user->update();
                    //return redirect('admin/info');
                    return back()->with('errors','修改密码成功');
                }
            }else{
                //dd($validator->errors()->all());
                return back()->withErrors($validator);
            }
        }else{
            return view('admin.pass');
        }
    }
}
