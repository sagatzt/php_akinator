<?php
require "header.php";
require "connectdb.php";

//OBTENEMOS EL NÚMERO DEL NODO DENTRO DEL ÁRBOL (PARA SABER QUÉ CAMINO HEMOS TOMADO)
$nodo = 1;
$nodoRepuesto = 0;
$numPregunta = 1;
$proxPregunta = 2;

if(isset($_GET['n'])) $nodo = $_GET["n"];
if(isset($_GET['r'])) $nodoRepuesto = $_GET["r"];
if(isset($_GET['np'])) {
	$numPregunta = $_GET["np"];
	$proxPregunta = $numPregunta+1;
}

//SI HAY UN NODO DE REPUESTO SE AÑADE A LA LISTA (ARRAY)
if($nodoRepuesto!=0){
	session_start();	//iniciamos la sesión
	$nodosRepuesto =array();	//creamos el array
	//COMPROBAMOS SI EXISTE LA VARIABLE DE SESIÓN (ES DECIR, SI HEMOS GUARDADO ALGÚN NODO EN EL QUE DUDÁSEMOS)
	if(isset($_SESSION['nodosRepuesto'])){
		$nodosRepuesto = $_SESSION['nodosRepuesto'];	//Guardamos el array de la sesión en el array vacío
		array_push($nodosRepuesto,$nodoRepuesto);		//añadimos el nodo a la lista
		$_SESSION['nodosRepuesto']=$nodosRepuesto;		//Volvemos a guardar el array de la sesión, actualizado
	}
	else{
		array_push($nodosRepuesto,$nodoRepuesto);		//añadimos el nodo a la lista
		$_SESSION['nodosRepuesto']=$nodosRepuesto;
	}
}
//CALCULAMOS LO SIGUIENTES PASOS A SEGUIR
$nodoSi = $nodo * 2;
$nodoNo = $nodo * 2 + 1;
$nodoProbablementeSi = $nodoSi;
$nodoProbablementeNo = $nodoNo;
//OBTENEMOS UN NÚMERO AL AZAR ENTRE CERO Y UNO
//lo hacemos para evitar que tenga una tendencia a recorrer siempre el mismo camino
$aleatrio = rand(0,1);
$nodoAleatorio 	  = 0;	//EL QUE ELEGIMOS
$nodoAleatorioAlt = 0;	//EL CONTRARIO
if($aleatrio==0){
	$nodoAleatorio = $nodoNo;
	$nodoAleatorioAlt = $nodoSi;
}
else{
	$nodoAleatorio = $nodoSi;
	$nodoAleatorioAlt = $nodoNo;
}

//HACEMOS LA CONSULTA A LA BD
$consulta = "SELECT texto,pregunta FROM arbol WHERE nodo = ".$nodo.";";
$texto = '';
$pregunta = true;
if ($resultado = mysqli_query($enlace, $consulta)) {
	if($resultado->num_rows === 0)
        echo 'No existe el nodo';
	else{
		while ($fila = mysqli_fetch_row($resultado)) {
			$texto 	  = $fila[0];
			$pregunta = $fila[1];
		}
		//SI NO ES UNA PREGUNTA ES UN RESULTADO FINAL (JAVINATOR DA UNA RESPUESTA)
		echo "<main class='container'>";
		if($pregunta == 0){
			echo "<div class='pregunta'>";
			echo "<h2>¿Estás pensando en ". $texto . "?</h2>";
			echo "</div>";
			echo "<div class='respuestas d-flex justify-content-center'>";
			echo "<a class='btn btn-primary' href='respuesta.php?r=1&n=".$nodo."&p=".$texto."&np=".$proxPregunta."'>SÍ</a>";
			echo "<a class='btn btn-danger' href='respuesta.php?r=0&n=".$nodo."&p=".$texto."&np=".$proxPregunta."'>NO</a>";
			echo "</div>";
		}else{//SI ES UNA PREGUNTA, PREGUNTAMOS (SI DUDAMOS, EN EL PARÁMETRO "R" GUARDAMOS LA RAMA ALTERNATIVA, SINO VALE CERO)
			echo "<div class='pregunta d-flex justify-content-center'>";
			echo "<h2>¿Tu personaje ". $texto . "?</h2>";
			echo "</div>";
			echo "<div class='respuestas'>";
			echo "<div class='d-flex justify-content-center'>";
			echo "<a class='btn btn-success' href='index.php?n=".$nodoSi."&r=0&np=".$proxPregunta."'>SÍ</a>";
			echo "<a class='btn btn-danger' href='index.php?n=".$nodoNo."&r=0&np=".$proxPregunta."'>NO</a>";
			echo "</div><div class='d-flex justify-content-center'>";
			echo "<a class='btn btn-warning' href='index.php?n=".$nodoProbablementeSi."&r=".$nodoProbablementeNo."&np=".$proxPregunta."'>PROBABLEMENTE</a>";
			echo "<a class='btn btn-warning' href='index.php?n=".$nodoProbablementeNo."&r=".$nodoProbablementeSi."&np=".$proxPregunta."'>PROBABLEMENTE NO</a>";
			echo "</div><div class='d-flex justify-content-center'>";
			echo "<a class='btn btn-danger' href='index.php?n=".$nodoAleatorio."&r=".$nodoAleatorioAlt."&np=".$proxPregunta."'>NO LO SÉ</a>";
			echo "</div>";
			echo "<div class='limpiar'></div>";
			echo "</div>";
		}
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