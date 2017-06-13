<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="/Public/statics/hplus/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Public/statics/hplus/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/statics/hplus/css/animate.css" rel="stylesheet">
    <link href="/Public/statics/hplus/css/style.css" rel="stylesheet">
    <link href="/Public/statics/hplus/css/login.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>
        if (window.top !== window.self) {
            window.top.location = window.location;
        }
    </script>

</head>

<body class="signin">
    <div class="signinpanel">
        <div class="row">
            <div class="col-sm-7">
                <div class="signin-info">
                    <div class="logopanel m-b">
                        <h1>[ H+ ]</h1>
                    </div>
                    <div class="m-b"></div>
                    <h4>欢迎使用 <strong>H+ 后台主题UI框架</strong></h4>
                    <ul class="m-b">
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势一</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势二</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势三</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势四</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势五</li>
                    </ul>
                    <strong>还没有账号？ <a href="index.php?m=admin&c=index&a=register">立即注册&raquo;</a></strong>
                </div>
            </div>
            <div class="col-sm-5">
                <h4 class="no-margins">登录：</h4>
                <p class="m-t-md">登录到H+后台主题UI框架</p>
                <input type="text" class="form-control uname" placeholder="用户名" name="username"/>
                <input type="password" class="form-control pword m-b" placeholder="密码" name="pwd"/>
                <a href="">忘记密码了？</a>
                <button class="btn btn-success btn-block" onclick="login()">登录</button>
            </div>
        </div>
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2015 All Rights Reserved. 
            </div>
        </div>
    </div>
    <script src="/Public/statics/hplus/js/jquery.min.js"></script>
    <script type="text/javascript">
    var login = function(){
        var url = "index.php?m=admin&c=index&a=login";//"<?php echo U('Admin/index/login');?>";
        var username = $('input[name=username]').val();
        var pwd = $('input[name=pwd]').val();
        var data = { 'username':username , 'pwd':pwd };
        $.post(url , data , function( res ){
            console.log(res);
        } , 'json');
    }
        
    </script>
</body>

</html>