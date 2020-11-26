<?php
require "connectdb.php";
require "header.php";
$consultas = [];
array_push($consultas,"DROP TABLE arbol");
array_push($consultas,"DROP TABLE partida");
echo "<main class='container'>";
echo "<h3>Desinstalar</h3>";
for($a=0; $a<count($consultas); $a++){
	echo "CONSULTA: " . $a . " ";
	if (mysqli_query($enlace, $consultas[$a])) 
		echo "OK";
	else
		echo "ERROR";
	echo "<br>";
}
mysqli_close($enlace);

?>
</main>
<?php
	require "footer.php";
?>	
</body>
</html>