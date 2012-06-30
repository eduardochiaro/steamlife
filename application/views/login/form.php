<?php $this->load->view('default/header'); ?>

	<h1>Steamlife Login</h1>
	
	<div class="container">
		<?php if(isset($error)):?><div class="error"><?php echo $error ?></div><?php endif;?>
		<?php if(validation_errors()):?><div class="error"><?php echo validation_errors() ?></div><?php endif;?>
	
	
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
	</div>

<?php $this->load->view('default/footer'); ?>