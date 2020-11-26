<?php
require "connectdb.php";
require "header.php";
$respuesta = $_GET["r"];
$nodo = $_GET["n"];
$nombreAnterior = $_GET["p"];
$numPregunta = $_GET["np"];
function formularioRespuesta($n,$p){
	echo "<main class='container'>";
	echo "<div class='pregunta'>";
	echo "<form action='crear.php' id='formulario' method='POST' >";
	echo "<input type='text' id='nodo' name='nodo' form='formulario' placeholder='nombre' style='display:none;' value='".$n."'>";
	echo "<input type='text' id='nombreAnterior' name='nombreAnterior' form='formulario' placeholder='nombre' style='display:none;' value='".$p."'>";
	echo "<h4>¿En quién habías pensado?</h4>";
	echo "<input type='text' id='nombre' name='nombre' form='formulario' placeholder='nombre' required>";
	echo "<hr>";
	echo "<h4>¿Qué característica tiene este personaje que no tenga ".$p."?</h4>";
	echo "<input type='text' id='caracteristicas' name='caracteristicas' form='formulario' placeholder='Por ejemplo: es una chica' required style='width:90%'>";
	echo "<button type='submit' class='btn btn-primary' name='ENVIAR'>ENVIAR</button>";
	echo "</form>";
	echo "</div>";
}
//SI HA FALLADO
if($respuesta == 0){
	session_start();			//iniciamos la sesión
	$nodosRepuesto =array();	//creamos el array
	//COMPROBAMOS SI EXISTE LA VARIABLE DE SESIÓN (ES DECIR, SI HEMOS GUARDADO ALGÚN NODO EN EL QUE DUDÁSEMOS)
	if(isset($_SESSION['nodosRepuesto'])){
		$nodosRepuesto = $_SESSION['nodosRepuesto'];
		$tamano = count($nodosRepuesto);			//medimos la longitud del array
		if($tamano != 0){
			//SI HAY ELEMENTOS EN EL ARRAY QUE PODAMOS USAR
			$nodoRevisar = array_pop($nodosRepuesto);	//obtenemos el último elemento del nodo y lo desapilamos
			$_SESSION['nodosRepuesto']=$nodosRepuesto;  //actualizamos el array con los valores nuevos
			header("Location:index.php?n=".$nodoRevisar."&r=0&np=".$numPregunta."");	//volvemos automáticamente al nodo
		}
		else//SI EL ARRAY CON NODOS DE REPUESTO ESTÁ VACÍO
			formularioRespuesta($nodo,$nombreAnterior);
	}
	else//SI NO HAY VARIABLE DE SESIÓN
		formularioRespuesta($nodo,$nombreAnterior);
}else{//SI HA ACERTADO
	//GUARDAMOS EL ACIERTO EN EL LOG DE LA BD (TABLA PARTIDA)
	$consulta = "INSERT INTO partida (personaje,acierto) VALUES('".$nombreAnterior."',TRUE);";
	mysqli_query($enlace, $consulta);
	//BORRAMOS LA VARIABLE DE SESIÓN CON EL ARRAY
	session_start();		//iniciamos la sesión
	$arrayVacio =array();	
	if(isset($_SESSION['nodosRepuesto']))
		$_SESSION['nodosRepuesto']=$arrayVacio;
	echo "<main class='container'>";
	echo "<h2 style='padding-top:20px'>¡GRACIAS POR JUGAR A AKINATOR FULLSTACK! ;)</h2>";
	echo "<img src='images/wow.jpg'>";
}
?>
</main>
<?php
	require "footer.php";
?>	
</body>
</html>

