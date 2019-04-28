<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>珠宝商城</title>
    <link rel="shortcut icon" href="{{asset('index/images/favicon.ico')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/page.css')}}">
    <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('layui/layui.js')}}"></script>
    <!-- Bootstrap -->
    <link href="{{asset('index/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('index/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('index/css/response.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('index/images/favicon.ico')}}" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('index/js/jquery.min.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('index/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('index/js/style.js')}}"></script>
    <!--焦点轮换-->
    <script src="{{asset('index/js/jquery.excoloSlider.js')}}"></script>
    <!-- jq加减 -->
    <script src="{{asset('index/js/jquery.spinner.js')}}"></script>
    <script>
      $(function () {
       $("#sliderA").excoloSlider();
       $('.spinnerExample').spinner({});
      });
    </script>
  </head>
  <body>
    <div class="maincont">
     @yield('content')