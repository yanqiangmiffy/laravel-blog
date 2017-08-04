@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;全部配置项
    </div>
    <!--面包屑导航 结束-->


    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_title">
                <h3>配置项管理</h3>
            </div>
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>添加配置项</a>
                    <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>全部配置项</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">

                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">排序</th>
                        <th class="tc" width="5%">ID</th>
                        <th>配置项标题</th>
                        <th>配置项名称</th>
                        <th>配置项内容</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $value)
                        <tr>
                            <td class="tc">
                                <input type="text" name="ord[]" onchange="changeOrder(this,{{$value->conf_id}})" value="{{$value->conf_order}}">
                            </td>
                            <td class="tc">{{$value->conf_id}}</td>
                            <td>
                                <a href="#">{{$value->conf_title}}</a>
                            </td>
                            <td>{{$value->conf_name}}</td>
                            <td>{!! $value->_html !!}</td>
                            <td>
                                <a href="{{url('admin/config/'.$value->conf_id.'/edit')}}">修改</a>
                                <a href="javascript:;" onclick="delCate({{$value->conf_id}})">删除</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    <script type="text/javascript">
        function changeContent(obj,conf_id) {
            var conf_content=$(obj).val();
            $.post("{{url('admin/config/changeContent')}}",{'_token':'{{csrf_token()}}','conf_id':conf_id,'conf_content':conf_content},function (data) {
                if(data.status==0){
                    layer.msg(data.msg, {icon: 6});
                }else {
                    layer.msg(data.msg, {icon: 5});
                }
            });
        }

        function changeOrder(obj,conf_id) {
            var conf_order=$(obj).val();
            $.post("{{url('admin/config/changeOrder')}}",{'_token':'{{csrf_token()}}','conf_id':conf_id,'conf_order':conf_order},function (data) {
                if(data.status==0){
                    location.href=location.href;
                    layer.msg(data.msg, {icon: 6});
                }else {
                    layer.msg(data.msg, {icon: 5});
                }
            });
        }

        //删除分类
        function delCate(conf_id) {
            //询问框
            layer.confirm('您确定要删除这个配置项吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/config/')}}/"+conf_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                    if(data.status==0){
                        location.href=location.href;
                        layer.msg(data.msg, {icon: 6});
                    }else{
                        layer.msg(data.msg, {icon: 5});
                    }
                });
            }, function(){

            });
        }

    </script>
@endsection
