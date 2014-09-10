Bienvenido, <strong><?php echo $email; ?></strong>!
<?php if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/login/cambiar_email/', 'Cambiar email'); ?> 
<?php if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/login/cambiar_clave/', 'Cambiar clave'); ?> 
<?php echo anchor('/login/logout/', 'Salir'); ?>