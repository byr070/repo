<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title>Crear una nueva clave en <?php echo $site_name; ?></title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Crear una nueva clave</h2>
Olvidó su clave, eh? No es gran cosa.<br />
Para crear una nueva clave, solo siga este enlace:<br />
<br />
<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/login/reset_clave/'.$usu_id.'/'.$usu_nueva_clave_key); ?>" style="color: #3366cc;">Crear una nueva clave</a></b></big><br />
<br />
El enlace no funciona? Copie el siguiente enlace en la barra de direcciones de su navegador:<br />
<nobr><a href="<?php echo site_url('/login/reset_clave/'.$usu_id.'/'.$usu_nueva_clave_key); ?>" style="color: #3366cc;"><?php echo site_url('/login/reset_clave/'.$usu_id.'/'.$usu_nueva_clave_key); ?></a></nobr><br />
<br />
<br />
Usted recibió este correo, porque fue solicitado por un usuario en <a href="<?php echo site_url(''); ?>" style="color: #3366cc;"><?php echo $site_name; ?></a>. Esto es parte del procedimiento para crear una nueva clave en el sistema. Si NO solicito una nueva clave, por favor ignore este email y su clave sera la misma.<br />
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
