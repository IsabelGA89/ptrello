<?php
$dsn = 'mysql:dbname=proyecto;host=localhost';
$cuenta="isa";
$contrasena="isa";

try {
    $consql = new PDO($dsn, $cuenta, $contrasena);
    $consql->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $consql->setAttribute( PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
} catch (PDOException $e) {
    print "(SQL) : Error al Conectar : " . $e->getMessage() . "<br/>";
    die();
}
?>
