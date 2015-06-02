<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>选呗 - [页面]</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/metro.css" rel="stylesheet" />
    <link href="/css/metro-icons.css" rel="stylesheet" />
    <link href="/css/global.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <script src="/js/jquery-1.9.1.min.js"></script>
      <script src="/js/bootstrap.min.js"></script>
      <script src="/js/metro.min.js"></script>
  </head>
  <body>
    <!-- 顶栏（未登录状态） -->
    <?php if ($userid == -1): ?>
        <div class="app-bar" data-role="appbar">
            <a class="app-bar-element" href="/">选呗</a>
            <span class="app-bar-divider"></span>
            <a class="app-bar-element place-right fg-white" href="/index.php/signup">注册</a>
            <div class="app-bar-element place-right">
                <a class="dropdown-toggle fg-white"><span class="mif-enter"></span> 登录</a>
                <div class="app-bar-drop-container bg-white fg-dark place-right" data-role="dropdown" data-no-close="true">
                    <div class="padding20">
                        <!--form-->
                        <?php echo form_open('page/login') ?>
                        <h4 class="text-light">登录选呗</h4>
                        
                        <div class="input-control text">
                            <span class="mif-user prepend-icon"></span>
                            <!--input type="text" name="username"-->
                            <?php echo form_input('Email') ?>
                        </div>
                        <div class="input-control text">
                            <span class="mif-lock prepend-icon"></span>
                            <!--input type="password" name="password"-->
                            <?php echo form_password('Pwd') ?>
                        </div>
                        <label class="input-control checkbox small-check">
                            <input type="checkbox" name="remember">
                            <span class="check"></span>
                            <span class="caption">自动登录</span>
                        </label>
                        <div class="form-actions">
                            <!--
                            <button class="button" type="submit">登录</button>
                        -->
                        <?php echo form_submit('submit', '登陆') ?>
                        <a class="button link" href="/register">没有账号？</a>
                    </div>
                    <?php echo form_close() ?>
                    <!--/form-->
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="app-bar" data-role="appbar">
        <a class="app-bar-element" href="/">选呗</a>
        <span class="app-bar-divider"></span>
        <a class="app-bar-element place-right fg-white" href="/index.php/page/logout"><?php echo $username ?></a>
    </div>
    <?php endif; ?>
