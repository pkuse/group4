<div class="container">
<div data-commentouted-style="padding: 60px 100px 10px;">
	<!--form class="form-signin"-->
	<?php echo form_open('page/sign', array('class' => 'form-signin')) ?>
	<h2 class="form-signin-heading">新用户注册</h2>
	<div class="input-group">
		<span class="input-group-addon">&nbsp&nbsp&nbsp&nbsp邮箱&nbsp&nbsp&nbsp</span>
		<input type='text' name='Email' value='<?php echo set_value('Email') ?>' class="form-control" placeholder="Email"/>
	</div>
	<font color='red'> <?php echo form_error('Email') ?></font>
	<br>
	<div class="input-group">
		<span class="input-group-addon">&nbsp&nbsp用户名&nbsp&nbsp</span>
		<input type='text' name='Name' value='<?php echo set_value('Name') ?>' class="form-control" placeholder="UserName"/>
	</div>
	<font color='red'> <?php echo form_error('Name') ?></font>
	<br>
	<div class="input-group">
		<span class="input-group-addon">&nbsp&nbsp&nbsp&nbsp密码&nbsp&nbsp&nbsp</span>
		<input type='password' name='Pwd' class="form-control" placeholder="Password"/>
	</div>		
	<font color='red'> <?php echo form_error('Pwd') ?></font>
	<br>
	<div class="input-group">
		<span class="input-group-addon">确认密码</span>
		<input type='password' name='PwdConfirm' class="form-control" placeholder="Password"/>
	</div>
	<font color='red'> <?php echo form_error('PwdConfirm') ?></font>
	<br>
	<p class="text-right"><input type='submit' name='register', value='注册' class="btn btn-info tn-lg" /></p>
	<?php echo form_close() ?>
</div>
</div>
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
