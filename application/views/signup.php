 <div class="container">
 	<?php echo form_open('page/sign') ?>
	
	<p>
	<h4>Name: </h4>
	<input type='text' name='Name' value='<?php echo set_value('Name') ?>' />
	<font color='red'> <?php echo form_error('Name') ?></font>
	</p>

	<p>
	<h4>Email: </h4>
	<input type='text' name='Email' value='<?php echo set_value('Email') ?>' />
	<font color='red'> <?php echo form_error('Email') ?></font>
	</p>

	<p>
	<h4>Password: </h4>
	<input type='password' name='Pwd' />
	<font color='red'> <?php echo form_error('Pwd') ?></font>
	</p>

	<p>
	<h4>Confirm password: </h4>
	<input type='password' name='PwdConfirm' />
	<font color='red'> <?php echo form_error('PwdConfirm') ?></font>
	</p>

	<input type='submit' name='register', value='注册' />

 	</form>
 </div>
