<div class="container">
<div style="padding: 60px 100px 10px;">
	<!--form class="form-signin"-->
	<?php echo form_open('page/sign', array('class' => 'form-signin')) ?>
	<h2 class="form-signin-heading">新用户注册</h2>
	<div class="input-group">
		<span class="input-group-addon">&nbsp&nbsp&nbsp&nbsp邮箱&nbsp&nbsp&nbsp</span>
		<input type='text' name='Email' value='<?php echo set_value('Email') ?>' class="form-control" placeholder="Email"/>
		<font color='red'> <?php echo form_error('Email') ?></font>
	</div>
	<br>
	<div class="input-group">
		<span class="input-group-addon">&nbsp&nbsp用户名&nbsp&nbsp</span>
		<input type='text' name='Name' value='<?php echo set_value('Name') ?>' class="form-control" placeholder="UserName"/>
		<font color='red'> <?php echo form_error('Name') ?></font>
	</div>
	<br>
	<div class="input-group">
		<span class="input-group-addon">&nbsp&nbsp&nbsp&nbsp密码&nbsp&nbsp&nbsp</span>
		<input type='password' name='Pwd' class="form-control" placeholder="Password"/>
		<font color='red'> <?php echo form_error('Pwd') ?></font>
	</div>		
	<br>
	<div class="input-group">
		<span class="input-group-addon">确认密码</span>
		<input type='password' name='PwdConfirm' class="form-control" placeholder="Password"/>
		<font color='red'> <?php echo form_error('PwdConfirm') ?></font>
	</div>
	<br>
	<p class="text-right"><input type='submit' name='register', value='注册' class="btn btn-info tn-lg" /></p>
	<?php echo form_close() ?>
</div>
</div>
