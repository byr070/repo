<?php
$nombre_completo = array(
	'name'	=> 'nombre_completo',
	'id'	=> 'nombre_completo',
	'value' => set_value('nombre_completo'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'autofocus'	=> 'autofocus',
	'placeholder' => 'Nombre completo'
);
$numero_cedula = array(
	'name'	=> 'numero_cedula',
	'id'	=> 'numero_cedula',
	'value' => set_value('numero_cedula'),
	'maxlength'	=> 10,
	'size'	=> 15,
	'placeholder' => 'Numero de cedula'
);
$crear_login = array(
	'name'	=> 'crear_login',
	'id'	=> 'crear_login',
	'value'	=> 1,
	'checked'	=> set_value('crear_login'),
	'style' => 'margin:0;padding:0',
);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
$clave = array(
	'name'	=> 'clave',
	'id'	=> 'clave',
	'value' => set_value('clave'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$confirmar_clave = array(
	'name'	=> 'confirmar_clave',
	'id'	=> 'confirmar_clave',
	'value' => set_value('confirmar_clave'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<div id='registrarEmpleado'>
<h1>Nuevo empleado</h1>
<?php echo form_open($this->uri->uri_string()); ?>
<table>
	<tr>
		<td><?php echo form_label('Nombre completo: ', $nombre_completo['id']); ?></td>
		<td><?php echo form_input($nombre_completo); ?></td>
		<td style="color: red;"><?php echo form_error($nombre_completo['name']); ?><?php echo isset($errors[$nombre_completo['name']])?$errors[$nombre_completo['name']]:''; ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Numero cedula: ', $numero_cedula['id']); ?></td>
		<td><?php echo form_input($numero_cedula); ?></td>
		<td style="color: red;"><?php echo form_error($numero_cedula['name']); ?><?php echo isset($errors[$numero_cedula['name']])?$errors[$numero_cedula['name']]:''; ?></td>
	</tr>
	<tr>
		<td>
			<?php echo form_checkbox($crear_login); ?>
			<?php echo form_label('Crear login', $crear_login['id']); ?>
		</td>
	</tr>
	<tr>
		<td><?php echo form_label('E-mail: ', $email['id']); ?></td>
		<td><?php echo form_input($email); ?></td>
		<td style="color: red;"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Clave: ', $clave['id']); ?></td>
		<td><?php echo form_password($clave); ?></td>
		<td style="color: red;"><?php echo form_error($clave['name']); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Confirmar Clave: ', $confirmar_clave['id']); ?></td>
		<td><?php echo form_password($confirmar_clave); ?></td>
		<td style="color: red;"><?php echo form_error($confirmar_clave['name']); ?></td>
	</tr>

	<?php if ($captcha_registration) { ?>
	<tr>
		<td colspan="3">
			<p>Introducir el codigo de la imagen:</p>
			<?php echo $captcha_html; ?>
		</td>
	</tr>
	<tr>
		<td><?php echo form_label('Codigo de confirmacion: ', $captcha['id']); ?></td>
		<td><?php echo form_input($captcha); ?></td>
		<td style="color: red;"><?php echo form_error($captcha['name']); ?></td>
	</tr>
	<?php } ?>
</table>
<?php echo form_submit('registrar', 'Registrar'); ?>
<?php echo form_close(); ?>
</div>