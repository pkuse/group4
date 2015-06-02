 <div class="container">
 	<?php echo form_open('page/sign') ?>
 	<p>Email: <?php echo form_input('Email') ?></p>
 	<p>Name: <?php echo form_input('Name') ?></p>
 	<p>Password: <?php echo form_password('Pwd' )?></p>
 	<p>Confirm password: <?php echo form_password('PwdConfirm') ?></p>
 	<?php echo form_submit('submit', '注册')?>
 	<?php echo form_close() ?>
 </div>