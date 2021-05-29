<?php

/*require $_SERVER['DOCUMENT_ROOT'] .'functions.php';*/
require "../../functions.php";

$info = "";
$error = "";

if($_POST['actualizar']){
    $email = $_POST['email'] ?? null;
    $pass = $_POST['password'] ?? null;
    $pass2 = $_POST['password2'] ?? null;

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
        $error =("Falló la conexión con la base de datos: %s\n". mysqli_connect_error());
        exit();
    }else{
        $msj = "Conexión exitosa con la bd";
    }
    $consulta ="select * from users where email='$email'";

    if ($resultado = $conn->query($consulta)) {
        $arr_info = $resultado->fetch_array();
        $resultado->close();
    }
    /* cerrar la conexión */
    $conn->close();

    if($arr_info['email']){
        //comprobar que ambas contraseñas sean la misma:
        if($pass == $pass2){
            //Update
            $secure_pass = password_hash($pass,PASSWORD_BCRYPT);
            $query = "UPDATE users SET password='$secure_pass' WHERE email='$email'";
            if ($conn->query($query) === TRUE) {
                $info = "Se ha actualizado la contraseña, ya puede usar sus nuevas credenciales para acceder a la aplicación.";
                header('Location:login.php');
                exit();
            } else {
                $error = "Error: $conn->error";
            }
        }else{
            $error = "Las contraseñas introducidas no coinciden.";
        }

    }else{
        $error = "El email introducido no se encuentra en la base de datos.";
    }

}



?>
<!doctype html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport"
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!--Tailwindcss-->
    <link href="https://unpkg.com/tailwindcss@1.0.4/dist/tailwind.min.css" rel="stylesheet">
    <!--Personal css-->
    <link rel="stylesheet" href="../css/style.css">
    <title>Consultas a tableros de Trello</title>
    <!--Favicon-->
    <link rel="icon" type="image/png" sizes="32x32" href="img/icon.png">
    <!--ICONOS FONT AWESOME-->
    <script src="https://kit.fontawesome.com/b4f679ca0a.js" crossorigin="anonymous"></script>
    <style>
        .group:focus .group-focus\:flex {
            display: flex;
        }
    </style>
</head>

<body class="h-screen overflow-hidden flex items-center justify-center" style="background-color: #161616;">

<div class="container max-w-md mx-auto xl:max-w-3xl h-full flex bg-white rounded-lg shadow overflow-hidden">
    <?php
    if ($error != "") {
        ?>
        <!--Msj section-->
        <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative"
             role="alert">
          <span class="mr-1">
            <svg class="fill-current text-red-500 inline-block h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24" width="24" height="24">
              <path class="heroicon-ui"
                    d="M15 19a3 3 0 0 1-6 0H4a1 1 0 0 1 0-2h1v-6a7 7 0 0 1 4.02-6.34 3 3 0 0 1 5.96 0A7 7 0 0 1 19 11v6h1a1 1 0 0 1 0 2h-5zm-4 0a1 1 0 0 0 2 0h-2zm0-12.9A5 5 0 0 0 7 11v6h10v-6a5 5 0 0 0-4-4.9V5a1 1 0 0 0-2 0v1.1z"/>
            </svg>
          </span>
            <span>
           <?php
           if ($error != "") {
               echo $error;
           } ?>
          </span>
        </div>
        <?php
    }
    ?>

    <?php
    if ($info != "") {
        ?>
        <!--Msj section-->
        <div class="block text-sm text-blue-600 bg-blue-200 border border-blue-400 h-12 flex items-center p-4 rounded-sm relative"
             role="alert">
          <span class="mr-1">
            <svg class="fill-current text-blue-500 inline-block h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24" width="24" height="24">
              <path class="heroicon-ui"
                    d="M15 19a3 3 0 0 1-6 0H4a1 1 0 0 1 0-2h1v-6a7 7 0 0 1 4.02-6.34 3 3 0 0 1 5.96 0A7 7 0 0 1 19 11v6h1a1 1 0 0 1 0 2h-5zm-4 0a1 1 0 0 0 2 0h-2zm0-12.9A5 5 0 0 0 7 11v6h10v-6a5 5 0 0 0-4-4.9V5a1 1 0 0 0-2 0v1.1z"/>
            </svg>
          </span> <?php
            if ($info != "") {
                echo $info;
            } ?>
            <span>

          </span>
        </div>
        <?php
    }
    ?>
    <div class="relative hidden xl:block xl:w-1/2 h-full">
        <img
                class="absolute h-auto w-full object-cover"
                src="https://images.unsplash.com/photo-1541233349642-6e425fe6190e"
                alt="my zomato"
        />
    </div>
    <div class="w-full xl:w-1/2 p-8">
        <form method="post" action="recovery.php">
            <h1 class=" text-2xl font-bold">Resetea tu contraseña</h1>
            <div>
        <span class="text-gray-600 text-sm">
            Introduce tu email, por favor
        </span>
            </div>
            <div class="mb-4 mt-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">
                    Email
                </label>
                <input
                        class="text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10"
                        name="email"
                        type="text"
                        placeholder="email@gmail.com"
                        required
                />
            </div>
            <div class="mb-6 mt-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2" htmlFor="password">
                    Password
                </label>
                <input
                        class="text-sm bg-gray-200 appearance-none rounded w-full py-2 px-3 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline h-10"
                        name="password"
                        type="password"
                        placeholder="Tu nueva contraseña"
                        required/>

                </a>
            </div>
            <div class="mb-6 mt-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2" htmlFor="password2">
                    Repite la contraseña
                </label>
                <input
                        class="text-sm bg-gray-200 appearance-none rounded w-full py-2 px-3 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline h-10"
                        name="password2"
                        type="password"
                        placeholder="Tu nueva contraseña
required"/>

                </a>
            </div>
            <div class="flex w-full mt-8">
                <input
                        class="w-full bg-gray-800 hover:bg-grey-900 text-white text-sm py-2 px-4 font-semibold rounded focus:outline-none focus:shadow-outline h-10"
                        type="submit" value="Confirmar cambio de contraseña" name="actualizar"
                >

                </input>
            </div>
        </form>
    </div>
</div>
</body>
<!-- Footer -->
<!--<footer class="page-footer font-small">
    <div class="footer-copyright text-center py-3">© 2021 Copyright
        Isabel González Anzano
    </div>
</footer>-->
<!-- Footer -->
