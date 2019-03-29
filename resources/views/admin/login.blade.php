<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>登录 - 后台管理系统</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="后台管理系统">
    <meta name="description" content="后台管理系统">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

    <link href="{{ asset('admin/css/bootstrap.min14ed.css?v=3.3.6') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/font-awesome.min93e3.css?v=4.4.0') }}" rel="stylesheet">

    <link href="{{ asset('admin/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css?v=') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen  animated fadeInDown container">
    <div>
        <div>
            <h1 class="logo-name">H</h1>
        </div>
        <h3>欢迎使用 后台管理系统</h3>

        <form id="login_form" name="login_form" method="post" action="{{ url('admincp/login') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" maxlength="30" name="admin_name" id="admin_name" class="form-control" placeholder="手机号" value="{{ old('admin_name') }}">
            </div>
            <div class="form-group">
                <input type="password" maxlength="20" name="admin_password" id="admin_password" class="form-control" placeholder="密码" value="{{ old('admin_password') }}">
            </div>
            <div class="form-group">
                <input type="text" maxlength="10" name="yam" id="yam" class="form-control" placeholder="验证码" style="width:50%">
                <img src="{!! captcha_src() !!}" alt="验证码" title="点击换一张" id="captcha_img" style="float: right;margin-top:-34px" width="100" height="34" border="0">
            </div>
            <button type="button" class="btn btn-primary block full-width m-b" id="btn_login">登 录</button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <p class="text-muted text-center" style="color:red;" id="msg">
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                @endif
            </p>
        </form>
    </div>
</div>
<script src="{{ asset('admin/js/jquery.min.js?v=2.1.4') }}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js?v=3.3.6') }}"></script>
</body>
</html>
<script type="text/javascript">
    function form_check(){
        var username = $('#admin_name').val();
        var mima = $('#admin_password').val();
        var yanzhengma = $('#yam').val();

        if(username.length == 0){
            $('#msg').html('您还没有输入手机号!');
            return false;
        }
        if(mima.length == 0){
            $('#msg').html('您还没有输入密码!');
            return false;
        }
        if(yanzhengma.length == 0){
            $('#msg').html('您还没有输入验证码!');
            return false;
        }
        return true;
    }

    function get_captcha(){
    	$.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'get',
            url:"{{ url('admincp/get_captcha') }}",
            data:'',
            dataType:'json',
            success:function(data){
                if(data.code=="1"){
                	$("#captcha_img").attr("src",data.data);
                }
            },
            error:function(){}
        });
    }

    $(function(){
    	$('#btn_login').click(function(){
            if(form_check()){
            	$("#login_form").submit();
            }
        });

        $("#captcha_img").click(function(){
        	get_captcha();
        })
    });
</script>