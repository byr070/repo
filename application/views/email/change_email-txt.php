Hola <?php echo $usu_email; ?>,

Ha cambiado su direccion email en <?php echo $site_name; ?>.
Siga este enlace para confirmar su nueva direccion email:

<?php echo site_url('/login/reset_email/'.$usu_id.'/'.$usu_nueva_clave_key); ?>


Su nuevo email: <?php echo $usu_nuevo_email; ?>


Usted recibió este correo, porque fue solicitado por un usuario en <?php echo $site_name; ?>. Si ha recibido esto por error, por favor NO haga clic en el enlace de confirmacion, y simplemente elimine este correo. Despues de corto tiempo, la solicitud sera eliminada del sistema.


Gracias,
The <?php echo $site_name; ?> Team
