<div id="login_form">
	<?php if (isset($account_created)) { ?>
		<h3><?php echo $account_created; ?></h3>
	<?php } else { ?>
		<h1>Login.</h1>
	<?php } ?>
	
	<?php
	echo form_open('login/validate_credentials');?>
	<fieldset id="inputs">
	<?php
	echo form_input('username', '','placeholder="Usuario" autofocus');
	echo form_password('password', '', 'placeholder="Clave" class="password"');
	?>
	</fieldset>
	<?php
	echo form_submit('submit', 'Entrar');
	echo anchor('login/signup','Crear cuenta');
	echo form_close();
	?>
	
</div>
