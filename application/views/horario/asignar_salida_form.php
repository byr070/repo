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
?>
<div id='asignarSalida'>
<h1>Nueva salida</h1>
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
</table>
<?php echo form_submit('asignar', 'Asignar'); ?>
<?php echo form_close(); ?>
</div>