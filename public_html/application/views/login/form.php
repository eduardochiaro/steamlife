<?php $this->load->view('default/header'); ?>

	<h1>Steamlife Login</h1>
	
	
	<?php if(isset($error)):?><div class="error"><?php echo $error ?></div><?php endif;?>
	
	<form class="box login">
	<fieldset class="boxBody">
	  <label>Username</label>
	  <input type="text" tabindex="1" placeholder="PremiumPixel" required>
	  <label><a href="#" class="rLink" tabindex="5">Forget your password?</a>Password</label>
	  <input type="password" tabindex="2" required>
	</fieldset>
	<footer>
	  <label><input type="checkbox" tabindex="3">Keep me logged in</label>
	  <input type="submit" class="btnLogin" value="Login" tabindex="4">
	</footer>
</form>
    <?php 
	echo form_open('login',array('class' => 'box login'));
	
	echo form_fieldset('',array('class' => 'boxBody'));
	echo form_label('Email');
	echo form_input('username', '', array('tabindex'=>1, 'placeholder'=>'steam@thedeveloperinside.com', 'required'=>1));

	
	echo form_label('Password');
	echo form_password('password', '', array('tabindex'=>3, 'required'=>1));
	echo form_fieldset_close(); 
	echo '<footer>';
	echo form_button(array('type'=>'submit','content'=>'Log in','class' => 'btnLogin'));
	echo '</footer>';
	echo form_close();
	?>


<?php $this->load->view('default/footer'); ?>