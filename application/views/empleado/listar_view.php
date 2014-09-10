<div id='listaEmpleados'>
	<h1>Lista empleados</h1>
	<?php echo 	anchor('/empleado/registrar/','Nuevo empleado'); ?>
	<?php echo $this->table->generate(); ?>
</div>