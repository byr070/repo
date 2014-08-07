<div id="register_form">
	<h1>Crear usuario</h1>
		<?php
		echo form_open('login/crear_usuario');
		echo form_input('email', set_value('email','Email Address'));
		echo form_password('clave', '', 'placeholder="Clave" class="password"');
		echo form_password('confirmacion_clave', '', 'placeholder="Confirmar clave" class="password_confirm"');
		echo form_submit('submit', 'Crear usuario');
		?>
		<?php echo validation_errors('<p class="error">'); ?>
</div>
