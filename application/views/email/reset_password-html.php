<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title>Su nueva clave en <?php echo $site_name; ?></title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Su nueva clave en <?php echo $site_name; ?></h2>
Ha cambiado su clave.<br />
Por favor, mantengala en sus registros para que no se olvide.<br />
<br />
Su direccion email: <?php echo $usu_email; ?><br />
Su nueva clave: <?php echo $usu_nueva_clave; ?><br />

<?php /* Your new password: <?php echo $usu_nueva_clave; ?><br /> */ ?>
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
