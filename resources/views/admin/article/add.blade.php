@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 添加文章
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>文章管理</h3>
            @if(count($errors)>0)
                <div class="mark">
                    @if(is_object($errors))
                        @foreach($errors->all() as $error)
                            <p> {{$error}}</p>
                        @endforeach
                    @else
                        <p>{{$errors}}</p>
                    @endif
                </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>新增文章</a>
                <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/article')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120">分类：</th>
                    <td>
                        <select name="cate_id">
                            @foreach($data as $key=>$value)
                                <option value="{{$value['cate_id']}}">{{$value['_cate_name']}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <th>文章标题：</th>
                    <td>
                        <input type="text" class="lg" name="art_title">
                        <p>标题可以写30个字</p>
                    </td>
                </tr>

                <tr>
                    <th>编辑：</th>
                    <td>
                        <input type="text" class="sm" name="art_editor">
                    </td>
                </tr>
                <tr>
                    <th>缩略图：</th>
                    <td>

                        <input type="text" class="lg" name="art_thumb">
                        <script src="{{asset('resources/org/uploadifive/jquery.uploadifive.min.js')}}" type="text/javascript"></script>
                        <link rel="stylesheet" type="text/css" href="{{asset('resources/org/uploadifive/uploadifive.css')}}">
                        <style type="text/css">
                            .uploadifive-button {
                                float: left;
                                margin-right: 10px;
                            }
                            .do_button{
                                text-decoration: none;
                                background-color: #505050;
                                background-image: linear-gradient(bottom, #505050 0%, #707070 100%);
                                background-image: -o-linear-gradient(bottom, #505050 0%, #707070 100%);
                                background-image: -moz-linear-gradient(bottom, #505050 0%, #707070 100%);
                                background-image: -webkit-linear-gradient(bottom, #505050 0%, #707070 100%);
                                background-image: -ms-linear-gradient(bottom, #505050 0%, #707070 100%);
                                background-image: -webkit-gradient(
                                        linear,
                                        left bottom,
                                        left top,
                                        color-stop(0, #505050),
                                        color-stop(1, #707070)
                                );
                                background-position: center top;
                                background-repeat: no-repeat;
                                -webkit-border-radius: 30px;
                                -moz-border-radius: 30px;
                                border-radius: 30px;
                                border: 2px solid #808080;
                                color: #FFF;
                                font: bold 12px Arial, Helvetica, sans-serif;
                                text-align: center;
                                text-shadow: 0 -1px 0 rgba(0,0,0,0.25);
                                display: inline-block;
                                width: 90px;
                                height: 20px;
                                padding: 5px;
                            }
                        </style>
                        <input id="file_upload"  type="file">
                        <a class="do_button" href="javascript:$('#file_upload').uploadifive('upload')">上传图片</a>
                        <script type="text/javascript">
                            $(function() {
                                $('#file_upload').uploadifive({
                                    'buttonText'   : '选择图片',
                                    'removeCompleted' : true,
                                    'auto'             : false,
                                    'checkScript'      : "{{asset('resources/org/uploadifive/check-exists.php')}}",
                                    'formData'         : {
                                        'timestamp' : '1501648859',
                                        '_token'     : "{{csrf_token()}}",
                                    },
                                    'uploadScript'     : "{{url('admin/upload')}}",
                                    'onUploadComplete' : function(file, data) {
                                        $('input[name=art_thumb]').val(data);
                                        $('#art_thumb_img').attr('src','/'+data);
                                    }
                                });
                            });
                        </script>

                    </td>

                </tr>
                <tr>
                    <th></th>
                    <td>
                        <img src="" alt="" id="art_thumb_img" style="max-width: 350px;max-height: 350px;">
                    </td>
                </tr>
                <tr>
                    <th>关键字：</th>
                    <td>
                        <input type="text" class="lg" name="art_tag">
                    </td>
                </tr>
                <tr>
                    <th>描述：</th>
                    <td>
                        <textarea name="art_description"></textarea>
                    </td>
                </tr>

                <tr>
                    <th>文章内容</th>
                    <td>
                        <script type="text/javascript" charset="utf-8" src="{{url('resources/org/ueditor/ueditor.config.js')}}"></script>
                        <script type="text/javascript" charset="utf-8" src="{{url('resources/org/ueditor/ueditor.all.min.js')}}"> </script>
                        <script type="text/javascript" charset="utf-8" src="{{url('resources/org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                        <script id="editor" name="art_content" type="text/plain" style="width:800px;height:500px;">

                        </script>
                        <script type="text/javascript">
                            var ue = UE.getEditor('editor');
                        </script>
                        <style>
                            .edui-default{line-height: 28px;}
                            div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                            {overflow: hidden; height:20px;}
                            div.edui-box{overflow: hidden; height:22px;}
                        </style>
                    </td>
                </tr>

                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
@endsection
