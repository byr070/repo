Bienvenido, <strong><?php echo $email; ?></strong>! Estás dentro. <?php echo anchor('/login/logout/', 'Salir'); ?>
<?php if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/login/cambiar_email/', 'Cambiar email'); ?>
<?php if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/login/cambiar_clave/', 'Cambiar clave'); ?>
