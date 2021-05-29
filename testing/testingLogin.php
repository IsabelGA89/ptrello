<?php
spl_autoload_register(function ($clase) {
    include 'classes/' . $clase . '.clase.php';
});
$msj ="";

$con = new Heroku();
$msj = $con->getStatus();
$consulta = "SELECT * FROM  users WHERE username=isa";
$res = $con->consulta_fetch($consulta);
var_dump($res);


$con->cerrar;
echo $msj;


