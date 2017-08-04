<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @yield('info')
    <link href="{{asset('resources/views/home/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/new.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('resources/views/home/js/modernizr.js')}}"></script>
    <![endif]-->
</head>
<body>
<header>
    <div id="logo"><a href="{{url('/')}}"></a></div>
    <nav class="topnav" id="topnav">
        @foreach($navs as $key=>$value)<a href="{{$value->nav_url}}"><span>{{$value->nav_name}}</span><span class="en">{{$value->nav_alias}}</span></a>@endforeach
    </nav>
</header>
@section('content')
    <h3>
        <p>最新<span>文章</span></p>
    </h3>
    <ul class="rank">
        @foreach($new as $key=>$value)
            <li><a href="{{url('art/'.$value->art_id)}}" title="Column 三栏布局 个人网站模板" target="_blank">{{$value->art_title}}</a></li>
        @endforeach
    </ul>
    <h3 class="ph">
        <p>点击<span>排行</span></p>
    </h3>
    <ul class="paih">
        @foreach($hot as $key=>$value)
            @if($key!=count($hot)-1)
                <li><a href="{{url('art/'.$value->art_id)}}" title="Column 三栏布局 个人网站模板" target="_blank">{{$value->art_title}}</a></li>
            @endif
        @endforeach

    </ul>
    <h3 class="links">
        <p>友情<span>链接</span></p>
    </h3>
    <ul class="website">
        @foreach($links as $key=>$value)
            <li><a href="{{$value->link_url}}" target="_blank">{{$value->link_name}}</a></li>

        @endforeach
    </ul>
@show
<footer>
    <p>{!! config('web.copyright') !!}<a href="/">{{config('web.web_count')}}</a></p>
</footer>
</body>
</html>
