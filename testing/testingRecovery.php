<?php

$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"], 1);
$active_group = 'default';
$query_builder = TRUE;

// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

if (mysqli_connect_errno()) {
    printf("Falló la conexión con la base de datos: %s\n", mysqli_connect_error());
    exit();
}

$consulta_email = "SELECT * FROM users WHERE email='j@gmail.com'";


if ($resultado = $conn->query($consulta_email)) {
    /* obtener el array de objetos */
    $obj = $resultado->fetch_array();
    if($obj !== null){
        //Si es distinto de null
        $secure_pass = password_hash('123',PASSWORD_BCRYPT);
        $query = "UPDATE users SET password='$secure_pass' WHERE email='j@gmail.com'";
        if ($conn->query($query) === true) {
            echo "Se ha actualizado la contraseña, ya puede usar sus nuevas credenciales para acceder a la aplicación.";
        } else {
            echo "Error: $conn->error";
        }
    }
    /* liberar el conjunto de resultados */
    $resultado->close();
}

/* cerrar la conexión */
$conn->close();
