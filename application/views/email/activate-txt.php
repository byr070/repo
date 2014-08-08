Bienvenido a <?php echo $site_name; ?>,

Gracias por unirse a <?php echo $site_name; ?>. Hemos listado sus datos de inicio de sesion a continuacion, asegurese de mantenerlos seguros.
Para verificar su direccion email, por favor siga este enlace:

<?php echo site_url('/login/activar/'.$usu_id.'/'.$usu_nuevo_email_key); ?>


Por favor verificar su email dentro de <?php echo $activation_period; ?> horas, caso contrario su registro se invalidara y debera registrase nuevamente.

Su direccion email: <?php echo $usu_email; ?>
Su clave: <?php echo $usu_clave; ?>
<?php if (isset($usu_clave)) { /* ?>
Your password: <?php echo $usu_clave; ?>
<?php */ } ?>



Gracias,
The <?php echo $site_name; ?> Team
