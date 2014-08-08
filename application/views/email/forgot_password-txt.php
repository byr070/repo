Hola <?php echo $usu_email; ?>,

Olvidó su clave, eh? No es gran cosa.
Para crear una nueva clave, solo siga este enlace:

<?php echo site_url('/login/reset_clave/'.$usu_id.'/'.$usu_nueva_clave_key); ?>


Usted recibió este correo, porque fue solicitado por un usuario en <?php echo $site_name; ?>. Esto es parte del procedimiento para crear una nueva clave en el sistema. Si NO solicito una nueva clave, por favor ignore este email y su clave sera la misma.


Gracias,
The <?php echo $site_name; ?> Team
