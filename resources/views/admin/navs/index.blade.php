@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;全部友情导航
    </div>
    <!--面包屑导航 结束-->


    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_title">
                <h3>友情导航管理</h3>
            </div>
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/navs/create')}}"><i class="fa fa-plus"></i>添加导航</a>
                    <a href="{{url('admin/navs')}}"><i class="fa fa-recycle"></i>全部导航</a>
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
                        <th>导航名称</th>
                        <th>导航别称</th>
                        <th>导航地址</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $value)
                        <tr>
                            <td class="tc">
                                <input type="text" name="ord[]" onchange="changeOrder(this,{{$value->nav_id}})" value="{{$value->nav_order}}">
                            </td>
                            <td class="tc">{{$value->nav_id}}</td>
                            <td>
                                <a href="#">{{$value->nav_name}}</a>
                            </td>
                            <td>{{$value->nav_alias}}</td>
                            <td>{{$value->nav_url}}</td>
                            <td>
                                <a href="{{url('admin/navs/'.$value->nav_id.'/edit')}}">修改</a>
                                <a href="javascript:;" onclick="delCate({{$value->nav_id}})">删除</a>
                            </td>
                        </tr>
                    @endforeach
                </table>






            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    <script type="text/javascript">
        function changeOrder(obj,nav_id) {
            var nav_order=$(obj).val();
            $.post("{{url('admin/nav/changeOrder')}}",{'_token':'{{csrf_token()}}','nav_id':nav_id,'nav_order':nav_order},function (data) {
                if(data.status==0){
                    layer.msg(data.msg, {icon: 6});
                }else {
                    layer.msg(data.msg, {icon: 5});
                }
            });
        }
        
        //删除分类
        function delCate(nav_id) {
            //询问框
            layer.confirm('您确定要删除这个导航吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/navs/')}}/"+nav_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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
