<div id='listaHorario'>
	<h1>Lista horario</h1>
	<?php echo anchor('/horario/listar_horario/','Listar horario'); ?>
	<?php echo anchor('/horario/asignar_horario/','Asignar horario'); ?>
	<?php echo anchor('/horario/listar_salida/','Listar salida'); ?>
	<?php echo anchor('/horario/asignar_salida/','Asignar salida'); ?>
	<?php echo $this->table->generate(); ?>
</div>