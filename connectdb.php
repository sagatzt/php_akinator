<?php

$mysql_host = "mysql-fullstack20-21.alwaysdata.net";
$mysql_usuario = "215702";
$mysql_passwd = "Temporal01";
$mysql_bd = "fullstack20-21_akinator";
$enlace = mysqli_connect($mysql_host, $mysql_usuario, $mysql_passwd, $mysql_bd);
/* comprobar la conexión */
if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}
mysqli_set_charset($enlace,"utf8");

?>
