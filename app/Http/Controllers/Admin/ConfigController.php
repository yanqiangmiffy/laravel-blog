<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ConfigController extends CommonController
{
    //get admin/config  配置列表
    public function index()
    {
        $data = Config::orderBy('conf_order','asc')->get();
        foreach ($data as $key=>$value){
            switch ($value->field_type){
                case 'input':
                    $data[$key]->_html='<input type="text" class="lg" onchange="changeContent(this,'.$value->conf_id.')" name="conf_content" value="'.$value->conf_content.'">';
                    break;
                case 'textarea':
                    $data[$key]->_html='<textarea type="text" class="lg" onchange="changeContent(this,'.$value->conf_id.')" name="conf_content" value="">'.$value->conf_content.'</textarea>';
                    break;
                case 'radio':
                    $arr=explode(',',$value->field_value);
                    $str='';
                    foreach ($arr as $m=>$n){
                       //0 => "格式1|开启"
                       $r=explode('|',$n);
                       $c=$value->conf_content==$r[0]?'checked':'';
                       $str.='<input type="radio" onchange="changeContent(this,'.$value->conf_id.')" name="conf_content" value="'.$r[0].'" '.$c.'>'.$r[1].'       ';
                    }
                    $data[$key]->_html=$str;
                    break;
            }
        }
        return view('admin.Config.index', compact('data'));

    }
    //更改配置内容
    public function changeContent()
    {
        $input = Input::all();
        $config = Config::find($input['conf_id']);
        $config->conf_content = $input['conf_content'];
        $re = $config->update();
        if ($re) {
            $data = [
                'status' => 0,
                'msg' => '配置内容更改成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'msg' => '配置内容更改失败'
            ];
        }
        $this->putFile();
        return $data;
    }
    //生成配置文件
    public function putFile()
    {
        //从数据库读取数据
        $config=Config::pluck('conf_content','conf_name')->all();
        $path=base_path().'\config\web.php';
        $str='<?php return '.var_export($config,true).';';
        file_put_contents($path,$str);
        //将数据存入文件
    }

    //更改配置排序
    public function changeOrder()
    {
        $input = Input::all();
        $config = Config::find($input['conf_id']);
        $config->conf_order = $input['conf_order'];
        $re = $config->update();
        if ($re) {
            $data = [
                'status' => 0,
                'msg' => '配置排序更改成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'msg' => '配置排序更改失败'
            ];
        }
        return $data;
    }

    //get admin/config/create  创建配置
    public function create()
    {
        return view('admin.config.add');
    }

    //post admin/config 添加配置提交
    public function store()
    {


        $input = Input::except('_token');
        $rules = [
            'conf_name' => 'required',
            'conf_title' => 'required',
        ];
        $message = [
            'conf_name.required' => '配置名称不能为空!',
            'conf_title.required' => '配置标题不能为空!',
        ];
        $validator = \Validator::make($input, $rules, $message);
        if ($validator->passes()) {
            $re = Config::create($input);
            if ($re) {
                return redirect('admin/config');
            } else {
                return back()->with('errors', '添加配置失败');
            }
        }
        else {
            return back()->withErrors($validator);
        }
    }
    //get admin/config/{config}/edit 编辑配置信息
    public function edit($conf_id)
    {
        $data=Config::find($conf_id);
        return view('admin.config.edit',compact('data'));
    }

    //put admin/config/{config}  更新单个配置信息
    public function update($conf_id)
    {
        $input=Input::except('_token','_method');
        $re=Config::where('conf_id',$conf_id)->update($input);
        if($re){
            $this->putFile();
            return redirect('admin/config');
        }else{
            return back()->with('errors','配置信息更新失败，请稍后重试');
        }
    }

    //delete admin/config/{config}  删除配置信息
    public function destroy($conf_id)
    {
        $re=Config::where('conf_id',$conf_id)->delete();
        if($re){
            $this->putFile();
            $data=[
                'status' => 0,
                'msg' => '配置信息删除成功'
            ];
        }else{
            $data=[
                'status' => 1,
                'msg' => '配置信息删除失败'
            ];
        }
        return $data;
    }

}
