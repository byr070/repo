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
$hora_inicio = array(
	'name'	=> 'hora_inicio',
	'id'	=> 'hora_inicio',
	'value' => set_value('hora_inicio'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'placeholder' => 'Hora inicio'
);
$hora_fin = array(
	'name'	=> 'hora_fin',
	'id'	=> 'hora_fin',
	'value' => set_value('hora_fin'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'placeholder' => 'Hora fin'
);
?>
<div id='asignarHorario'>
<h1>Asignar horario</h1>
<div id='submenu'>
	<?php echo anchor('/horario/listar_horario/','Listar horario'); ?>
	<?php echo anchor('/horario/asignar_horario/','Asignar horario'); ?>
	<?php echo anchor('/horario/listar_salida/','Listar salida'); ?>
	<?php echo anchor('/horario/asignar_salida/','Asignar salida'); ?>
</div>
<?php echo form_open($this->uri->uri_string()); ?>
<table>
	<tr>
		<td><?php echo form_label('Nombre completo: ', $nombre_completo['id']); ?></td>
		<td><?php echo form_input($nombre_completo); ?></td>
		<td style="color: red;"><?php echo form_error($nombre_completo['name']); ?><?php echo isset($errors[$nombre_completo['name']])?$errors[$nombre_completo['name']]:''; ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Hora inicio: ', $hora_inicio['id']); ?></td>
		<td><?php echo form_input($hora_inicio); ?></td>
		<td style="color: red;"><?php echo form_error($hora_inicio['name']); ?><?php echo isset($errors[$hora_inicio['name']])?$errors[$hora_inicio['name']]:''; ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Hora fin: ', $hora_fin['id']); ?></td>
		<td><?php echo form_input($hora_fin); ?></td>
		<td style="color: red;"><?php echo form_error($hora_fin['name']); ?><?php echo isset($errors[$hora_fin['name']])?$errors[$hora_fin['name']]:''; ?></td>
	</tr>
</table>
<?php echo form_submit('asignar', 'Asignar'); ?>
<?php echo form_close(); ?>
</div>