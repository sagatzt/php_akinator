<?php

require "connectdb.php";
require "header.php";
$consulta = "SELECT COUNT(*) FROM arbol WHERE pregunta = 0";
$numero = '0';
if ($resultado = mysqli_query($enlace, $consulta)) {
		while ($fila = mysqli_fetch_row($resultado)) 
			$numero= $fila[0];
    mysqli_free_result($resultado);
}
echo "<main class='container'>";
echo "<h3>Estadísticas</h3>";
echo "<h3>Personajes registrados: ".$numero."</h3>";
echo "<hr><br>";
//CONSULTA PARA VER ACIERTOS
$consulta = "SELECT COUNT(*) FROM partida WHERE acierto = TRUE";
$numero = '0';
if ($resultado = mysqli_query($enlace, $consulta)) {
		while ($fila = mysqli_fetch_row($resultado)) 
			$numero = $fila[0];
    mysqli_free_result($resultado);
}
echo "<h3>Aciertos: ".$numero."</h3>";
echo "<hr><br>";
//CONSULTA PARA VER FALLOS
$consulta = "SELECT COUNT(*) FROM partida WHERE acierto = FALSE";
$numero = '0';
if ($resultado = mysqli_query($enlace, $consulta)) {
		while ($fila = mysqli_fetch_row($resultado)) 
			$numero = $fila[0];
    mysqli_free_result($resultado);
}

echo "<h3>Fallos: ".$numero."</h3>";
echo "<hr><br>";
//CONSULTA PARA VER ÚLTIMOS PERSONAJES JUGADOS
$consulta = "SELECT personaje FROM partida ORDER BY id DESC LIMIT 10";
$nombre = '';
echo "<h3>ÚLTIMOS PERSONAJES JUGADOS</h3>";
if ($resultado = mysqli_query($enlace, $consulta)) {
		while ($fila = mysqli_fetch_row($resultado)) {
			$nombre = $fila[0];
			echo $nombre ."<br>";
		}
    mysqli_free_result($resultado);
}
?>
</main>
<?php
	require "footer.php";
?>	
</body>
</html>