<?php
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));


$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

if (mysqli_connect_errno()) {
    printf("Falló la conexión con la base de datos: %s\n", mysqli_connect_error());
    exit();
}
$consulta ="select * from users where username='isa'";

if ($resultado = $conn->query($consulta)) {

    /* obtener el array de objetos */
    while ($obj = $resultado->fetch_array()) {
        echo($obj);
    }
    /* liberar el conjunto de resultados */
    $resultado->close();
}

/* cerrar la conexión */
$conn->close();

