<<<<<<< HEAD
<!DOCTYPE html>
<html>
	<head>
	<body>
	<div id="login_form">
		<?php if (isset($account_created)) { ?>
			<h3><?php echo $account_created; ?></h3>
		<?php } 
		else { ?>
			<h1>LOGIN</h1>
		<?php } ?>
		
		<?php
		



		echo form_open('login/validar');?>
		<fieldset id="inputs">
		<?php
		echo form_input('e-mail', '','placeholder="E-mail" autofocus');
		echo form_password('clave', '', 'placeholder="Clave" class="password"');
		?>
		</fieldset>
		<?php
		echo form_submit('submit', 'Entrar');
		echo anchor('login/signup','Crear cuenta');
		echo form_close();
		?>
		
	</div>
	</body>
<html>
=======
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
>>>>>>> cf154d07c510c758d002a3c7e0639ebf2951055d
