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

$consulta_email = "SELECT * FROM users WHERE EMAIL='j@gmail.com'";


if ($resultado = $conn->query($consulta_email)) {
    /* obtener el array de objetos */
    $obj = $resultado->fetch_array();
    if($obj === null){
        //el email no existe insertamos:
        $pass = password_hash('123', PASSWORD_BCRYPT);
        $query = "INSERT INTO users(username,password,email) VALUES ('juan','$pass','j@gmail.com')";
        if ($conn->query($query) === TRUE) {
            echo "Nuevo registro creado";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }
    /* liberar el conjunto de resultados */
    $resultado->close();
}

/* cerrar la conexión */
$conn->close();
