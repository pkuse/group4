<html>
<head>
	<title>管理员登录</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<script src="/js/jquery-1.9.1.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<style type="text/css">
		<style type="text/css">
			body {
				padding-bottom: 40px;
				background-color: #f5f5f5;
			}

			.form-signin {
				max-width: 400px;
				padding: 19px 29px 19px;
				margin: 0 auto 20px;
				background-color: #fff;
				border: 1px solid #e5e5e5;
				-webkit-border-radius: 5px;
				-moz-border-radius: 5px;
				border-radius: 5px;
				-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
				-moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
				box-shadow: 0 1px 2px rgba(0,0,0,.05);
			}
			.form-signin .form-signin-heading, .form-signin .checkbox {
				margin-bottom: 20px;
			}
			.form-signin input[type="text"],
			.form-signin input[type="password"] {
				font-size: 16px;
				height: auto;
				padding: 7px 9px;
			}
		</style>
	</style>
</head>
<body>
	<div class="container">
		<div style="padding: 60px 100px 10px;">
			<!--form class="form-signin"-->
			<?php echo form_open('admin/login', array('class' => 'form-signin')) ?>
			<h2 class="form-signin-heading">管理员登录</h2>
			<div class="input-group">
				<span class="input-group-addon">&nbsp&nbsp管理员账号&nbsp&nbsp</span>
				<input type='text' name='Name' class="form-control" placeholder="Adminname"/>
			</div>
			<font color='red'> <?php echo form_error('Email') ?></font>
			<br>
			<div class="input-group">
				<span class="input-group-addon">&nbsp&nbsp管理员密码&nbsp&nbsp</span>
				<input type='password' name='Password' class="form-control" placeholder="Password"/>
			</div>
			
			<br>
			<p class="text-right"><input type='submit' name='admin', value='登录' class="btn btn-info tn-lg" /></p>
			<?php echo form_close() ?>
		</div>
	</div>


</body>
</html>