<?php
spl_autoload_register(function ($clase) {
    include 'classes/' . $clase . '.clase.php';
});

$connection = new Heroku();
   $con =  $connection->conectar();
$msj = $con->getStatus() ?? null;

/*$query = "SELECT * FROM users Where username=isa";
$result = $connection->query($query);*/

/* array numérico */
/*$row = $result->fetch_array(MYSQLI_NUM);
printf ("%s (%s)\n", $row[0], $row[1]);*/

/* liberar la serie de resultados */
/*$result->free();*/

/* cerrar la conexión */
/*$connection->close();*/


echo $msj;
