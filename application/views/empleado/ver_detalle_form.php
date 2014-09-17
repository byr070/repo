<?php //echo form_label('Empleado: '),form_dropdown('selEmpleados', $empleado); ?>
<?php
$nombre_completo = array(
	'name'	=> 'nombre_completo',
	'id'	=> 'nombre_completo',
	'value' => $empleado->emp_nombre_completo,
	'maxlength'	=> 80,
	'size'	=> 30,
	'autofocus'	=> 'autofocus',
	'placeholder' => 'Nombre completo'
);
$numero_cedula = array(
	'name'	=> 'numero_cedula',
	'id'	=> 'numero_cedula',
	'value' => $empleado->emp_numero_cedula,
	'maxlength'	=> 80,
	'size'	=> 30,
	'placeholder' => 'Numero cedula'
);
$fecha_nacimiento = array(
	'name'	=> 'fecha_nacimiento',
	'id'	=> 'fecha_nacimiento',
	'value' => $empleado->emp_fecha_nacimiento,
	'maxlength'	=> 80,
	'size'	=> 30,
	'placeholder' => 'Fecha nacimiento'
);
$lugar_nacimiento = array(
	'name'	=> 'lugar_nacimiento',
	'id'	=> 'lugar_nacimiento',
	'value' => $empleado->emp_lugar_nacimiento,
	'maxlength'	=> 80,
	'size'	=> 30,
	'placeholder' => 'Lugar nacimiento'
);
$provincia_residencia = array(
	'name'	=> 'provincia_residencia',
	'id'	=> 'provincia_residencia',
	'value' => $empleado->emp_provincia_residencia,
	'maxlength'	=> 80,
	'size'	=> 30,
	'placeholder' => 'Provincia residencia'
);
$creado = array(
	'name'	=> 'creado',
	'id'	=> 'creado',
	'value' => $empleado->emp_creado,
	'maxlength'	=> 80,
	'size'	=> 30,
	'placeholder' => 'Creado'
);
$org_id = array(
	'name'	=> 'org_id',
	'id'	=> 'org_id',
	'value' => $empleado->Organizacion_org_id,
	'maxlength'	=> 80,
	'size'	=> 30,
	'placeholder' => 'Cargo id'
);
$crg_id = array(
	'name'	=> 'crg_id',
	'id'	=> 'crg_id',
	'value' => $empleado->Cargo_crg_id,
	'maxlength'	=> 80,
	'size'	=> 30,
	'placeholder' => 'Cargo id'
);
$jor_id = array(
	'name'	=> 'jor_id',
	'id'	=> 'jor_id',
	'value' => $empleado->Jornada_jor_id,
	'maxlength'	=> 80,
	'size'	=> 30,
	'placeholder' => 'Jornada id'
);
$tip_id = array(
	'name'	=> 'tip_id',
	'id'	=> 'tip_id',
	'value' => $empleado->Tipo_tip_id,
	'maxlength'	=> 80,
	'size'	=> 30,
	'placeholder' => 'Tipo id'
);
$tar_id = array(
	'name'	=> 'tar_id',
	'id'	=> 'tar_id',
	'value' => $empleado->Tarjeta_tar_id,
	'maxlength'	=> 80,
	'size'	=> 30,
	'placeholder' => 'Tarjeta id'
);
?>

<div id='detalleEmpleado'>
<h1>Detalle empleado</h1>
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
		<td><?php echo form_label('Fecha nacimiento: ', $fecha_nacimiento['id']); ?></td>
		<td><?php echo form_input($fecha_nacimiento); ?></td>
		<td style="color: red;"><?php echo form_error($fecha_nacimiento['name']); ?><?php echo isset($errors[$fecha_nacimiento['name']])?$errors[$fecha_nacimiento['name']]:''; ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Lugar nacimiento: ', $lugar_nacimiento['id']); ?></td>
		<td><?php echo form_input($lugar_nacimiento); ?></td>
		<td style="color: red;"><?php echo form_error($lugar_nacimiento['name']); ?><?php echo isset($errors[$lugar_nacimiento['name']])?$errors[$lugar_nacimiento['name']]:''; ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Provincia residencia: ', $provincia_residencia['id']); ?></td>
		<td><?php echo form_input($provincia_residencia); ?></td>
		<td style="color: red;"><?php echo form_error($provincia_residencia['name']); ?><?php echo isset($errors[$provincia_residencia['name']])?$errors[$provincia_residencia['name']]:''; ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Creado: ', $creado['id']); ?></td>
		<td><?php echo form_input($creado); ?></td>
		<td style="color: red;"><?php echo form_error($creado['name']); ?><?php echo isset($errors[$creado['name']])?$errors[$creado['name']]:''; ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Organizacion: ', $org_id['id']); ?></td>
		<td><?php echo form_input($org_id); ?></td>
		<td style="color: red;"><?php echo form_error($org_id['name']); ?><?php echo isset($errors[$org_id['name']])?$errors[$org_id['name']]:''; ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Cargo: ', $crg_id['id']); ?></td>
		<td><?php echo form_input($crg_id); ?></td>
		<td style="color: red;"><?php echo form_error($crg_id['name']); ?><?php echo isset($errors[$crg_id['name']])?$errors[$crg_id['name']]:''; ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Jornada: ', $jor_id['id']); ?></td>
		<td><?php echo form_input($jor_id); ?></td>
		<td style="color: red;"><?php echo form_error($jor_id['name']); ?><?php echo isset($errors[$jor_id['name']])?$errors[$jor_id['name']]:''; ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Tipo: ', $tip_id['id']); ?></td>
		<td><?php echo form_input($tip_id); ?></td>
		<td style="color: red;"><?php echo form_error($tip_id['name']); ?><?php echo isset($errors[$tip_id['name']])?$errors[$tip_id['name']]:''; ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Tarjeta: ', $tar_id['id']); ?></td>
		<td><?php echo form_input($tar_id); ?></td>
		<td style="color: red;"><?php echo form_error($tar_id['name']); ?><?php echo isset($errors[$tar_id['name']])?$errors[$tar_id['name']]:''; ?></td>
	</tr>
</table>
<?php echo form_submit('registrar', 'Registrar'); ?>
<?php echo form_close(); ?>
</div>