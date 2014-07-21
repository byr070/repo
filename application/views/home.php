<html>
<head>
<title>Portada de mi sitio</title>
</head>
<body>
<h1>Bienvenido a mi web</h1>
<p>Estos son los últimos artículos publicados.</p>
<?php
while ($fila = mysql_fetch_array($rs_articulos)){
   echo '<p>';
   echo '<a href="' . site_url('/articulos/muestra/' . $fila['id']) . '">' . $fila['titulo'] . '</a>';
   echo '</p>';
}
?>

</body>
</html>
