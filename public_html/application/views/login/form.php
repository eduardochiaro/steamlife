<div id="login_form">
	<h1>Steamlife Login</h1>
	<?php if(isset($error)):?><div class="error"><?php echo $error ?></div><?php endif;?>
    <?php 
	echo form_open('login');
	echo form_input('username', 'Username');
	echo form_password('password', 'Password');
	echo form_submit('submit', 'Login');
	echo form_close();
	?>

</div><!-- end login_form-->