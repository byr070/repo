<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title>Bienvenido a <?php echo $site_name; ?>!</title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Bienvenido a <?php echo $site_name; ?>!</h2>
Gracias por unirse a <?php echo $site_name; ?>. Hemos listado sus datos de inicio de sesion a continuacion. Asegurese de mantenerlos seguros.<br />
Para abrir su pagina de inicio en <?php echo $site_name; ?>, por favor sigue este enlace:<br />
<br />
<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/login/entrar/'); ?>" style="color: #3366cc;">Ir a <?php echo $site_name; ?> ahora!</a></b></big><br />
<br />
El enlace no funciona? Copie el siguiente enlace en la barra de direcciones de su navegador:<br />
<nobr><a href="<?php echo site_url('/login/entrar/'); ?>" style="color: #3366cc;"><?php echo site_url('/login/entrar/'); ?></a></nobr><br />
<br />
<br />
Su direccion email: <?php echo $usu_email; ?><br />
Su clave: <?php echo $usu_clave; ?><br />
<?php /* Your password: <?php echo $usu_clave; ?><br /> */ ?>
<br />
<br />
Gracias,<br />
The <?php echo $site_name; ?> Team
</td>
</tr>
</table>
</div>
</body>
</html>
