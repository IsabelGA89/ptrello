<?php
session_start();
if ((!$_SESSION['user_id'])) {
    $login = "./auth/login.php";
    header("Location: $login");
    exit;
}
$info = "";
$error = "";

if (isset($_GET['info'])) {
    $info = $_GET['info'];
}

////// BD /////////////////////////////////////////////////////////////////////////////////////////////////////////////
//0.5º obtenemos el id del user
$bd_id = $_SESSION['user_id'];
//1º consulta datos en bd
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
    $msj = ("Falló la conexión con la base de datos: %s\n" . mysqli_connect_error());
    exit();
} else {
    $msj = "Conexión exitosa con la bd";
}
$consulta = "select * from users where id='$bd_id'";

if ($resultado = $conn->query($consulta)) {
    $arr_info = $resultado->fetch_array();
    $resultado->close();
}
$conn->close();
//2º Obtenemos la info de la cuenta
$email = $arr_info['email'];
$username = $arr_info['username'];
////// FIN  BD /////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Acciones
//UPDATE
if (isset($_POST['actualizar'])) {
    $new_username = $_POST['new_username'] ?? null;
    $new_pass = $_POST['new_pass'] ?? null;
    //Conexión Bd
    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $cleardb_server = $cleardb_url["host"];
    $cleardb_username = $cleardb_url["user"];
    $cleardb_password = $cleardb_url["pass"];
    $cleardb_db = substr($cleardb_url["path"], 1);
    $active_group = 'default';
    $query_builder = TRUE;
    $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
    if (mysqli_connect_errno()) {
        $msj = ("Falló la conexión con la base de datos: %s\n" . mysqli_connect_error());
        exit();
    } else {
        $msj = "Conexión exitosa con la bd";
    }

    switch (true) {
        case ($new_username != null) && ($new_pass != null):
            $secure_pass = password_hash($new_pass, PASSWORD_BCRYPT);
            $consulta = "UPDATE users SET password='$secure_pass',username='$new_username' WHERE id='$bd_id'";
            if ($conn->query($consulta) === true) {
                $info = "Datos modificados correctamente";
                header("Location:account.php?info=$info");
                exit();
            } else {
                $error = "Se ha producido un error tratando de modificar sus datos, por favor, contacte con un administrador.";
            }
            break;

        case $new_pass != null:
            $secure_pass = password_hash($new_pass, PASSWORD_BCRYPT);
            $consulta = "UPDATE users SET password='$secure_pass' WHERE id='$bd_id'";
            if ($conn->query($consulta) === true) {
                $info = "Se ha actualizado la contraseña correctamente";
            } else {
                $error = "Se ha producido un error tratando de modificar su contraseña, por favor, contacte con un administrador.";
            }
            break;
        case $new_username != null:
            $consulta = "UPDATE users SET username='$new_username' WHERE id='$bd_id'";
            if ($conn->query($consulta) === true) {
                $info = "Se ha actualizado el nombre de usuario correctamente";
                header("Location:account.php?info=$info");
                exit();
            } else {
                $error = "Se ha producido un error modificando su usario, por favor, contacte con un administrador.";
            }
            break;

    }
    $conn->close();
}
//DELETE
if (isset($_POST['eliminar'])) {
    $error ="se ha seleccionado eliminar";
    /*$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $cleardb_server = $cleardb_url["host"];
    $cleardb_username = $cleardb_url["user"];
    $cleardb_password = $cleardb_url["pass"];
    $cleardb_db = substr($cleardb_url["path"], 1);
    $active_group = 'default';
    $query_builder = TRUE;
    $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
    if (mysqli_connect_errno()) {
        $msj = ("Falló la conexión con la base de datos: %s\n" . mysqli_connect_error());
        exit();
    } else {
        $msj = "Conexión exitosa con la bd";
    }
    $consulta = "DELETE FROM users WHERE id='$bd_id'";
    $info= "se ejecuta consulta";
    /*if ($conn->query($consulta) === true) {
        $info = "Usuario eliminado correctamente";
        session_destroy();
        header("Location:./auth/login.php?info=$info");
        exit();
    }*/
    /*$conn->close();*/
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
    <link href="https://unpkg.com/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <!--Personal css-->
    <link rel="stylesheet" href="../css/style.css">
    <title>Cuenta</title>
    <!--Favicon-->
    <link rel="icon" type="image/png" sizes="32x32" href="../img/icon.png">
    <!--ICONOS FONT AWESOME-->
    <script src="https://kit.fontawesome.com/b4f679ca0a.js" crossorigin="anonymous"></script>
    <!--SweetAlert-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../libs/sweetalert2.all.min.js"></script>

    <style>
        .group:focus .group-focus\:flex {
            display: flex;
        }
    </style>
</head>

<body class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7;">

<div class="flex w-screen h-screen text-gray-400 bg-gray-900">
    <!--Navbar-->
    <div class="flex flex-col items-center w-16 pb-4 overflow-auto border-r border-gray-800 text-gray-500">
        <!--Info App-->
        <a class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4 rounded hover:bg-gray-800"
           href="../index.php">
            <i class="fas fa-home fa-2x"></i>
        </a>
        <!--Quien Soy-->
        <a class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4 rounded hover:bg-gray-800"
           target="_blank" href="quiensoy.php">
            <i class="fas fa-female fa-2x"></i>
        </a>
        <!--Report App-->
        <a class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4 rounded hover:bg-gray-800"
           href="report.php">
            <i class="fas fa-file-alt fa-2x"></i>
        </a>
        <!--Informacion de cuenta-->
        <a class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4  rounded hover:bg-gray-800"
           href="account.php">
            <i class="fas fa-id-card fa-2x"></i>
        </a>
    </div>

    <div class="flex flex-col flex-grow">
        <!--Header-->
        <div class="flex items-center flex-shrink-0 h-16 px-8 border-b border-gray-800">
            <h1 class="text-3xl font-medium">
                <h1 style="text-align: center;"><i class="fab fa-trello text-primary"></i>
                    Consultas a tableros de Trello
                </h1>
                <form action="auth/login.php" method="post"
                      class="flex btn items-center justify-center h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-400">
                    <i class="fas fa-sign-out-alt fa-lg"></i>
                    <input type="submit" name="logout" value="Log out"
                           class="flex btn items-center justify-center text-gray-400  h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-400"/>
                </form>
        </div>
        <!--Body-->
        <div class="flex-grow p-6 overflow-auto bg-gray-800">
            <div class="bg-cover bg-center border rounded-t-lg shadow-lg"
                 style="background-image: url(https://images.unsplash.com/photo-1572817519612-d8fadd929b00?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80)">
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
                <section class="py-40 bg-gray-100  bg-opacity-50 h-screen">
                    <div class="mx-auto container max-w-2xl md:w-3/4 shadow-md">
                        <!-- Icono y nombre-->
                        <div class="bg-white space-y-6 p-4 border-t-2 bg-opacity-5 border-indigo-400 rounded-t">
                            <div class="max-w-sm mx-auto md:w-full md:mx-0">
                                <div class="inline-flex items-center space-x-4">
                                    <span style="color: #818CF8;"><i class="fas fa-user-circle fa-5x"></i></span>
                                    <h1 class="uppercase text-gray-600 font-black"><?= $username ?></h1>
                                </div>
                            </div>
                        </div>
                        <!--Cuenta-->
                        <div class="bg-white space-y-6 p-4 border-t-2 bg-opacity-5 border-indigo-400">
                            <div class="md:inline-flex space-y-4 md:space-y-0 w-full p-4 text-gray-500 items-center">
                                <h2 class="md:w-1/3 max-w-sm mx-auto">Cuenta</h2>
                                <!--Email-->
                                <div class="md:w-2/3 max-w-sm mx-auto">
                                    <label class="text-sm text-gray-400">Email</label>
                                    <div class="w-full inline-flex border">
                                        <div class="pt-2 w-1/12 bg-gray-100 bg-opacity-50">
                                            <svg
                                                    fill="none"
                                                    class="w-6 text-gray-400 mx-auto"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                            >
                                                <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                                />
                                            </svg>
                                        </div>
                                        <input
                                                type="email"
                                                class="w-11/12 focus:outline-none focus:text-gray-600 p-2"
                                                placeholder="<?= $email ?>"
                                                disabled
                                        />
                                    </div>

                                    <form action="account.php" method="post">
                                        <!--Username-->

                                        <label class="text-sm mt-5 text-gray-400">Username</label>
                                        <div class="w-full inline-flex border">
                                            <div class="pt-2 w-1/12 bg-gray-100 bg-opacity-50">
                                                <svg
                                                        fill="none"
                                                        class="w-6 text-gray-400 mx-auto"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                >
                                                    <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                    />
                                                </svg>
                                            </div>
                                            <input
                                                    name="new_username"
                                                    type="text"
                                                    class="w-11/12 focus:outline-none focus:text-gray-600 p-2"
                                                    placeholder="<?= $username ?>"
                                            />
                                        </div>

                                </div>
                            </div>

                            <!--  <hr/>-->
                            <!-- Cambiar contraseña-->
                            <div class="md:inline-flex w-full space-y-4 md:space-y-0 p-8 text-gray-500 items-center">
                                <h2 class="md:w-4/12 max-w-sm mx-auto">Cambiar contraseña</h2>
                                <div class="md:w-5/12 w-full md:pl-9 max-w-sm mx-auto space-y-5 md:inline-flex pl-2">
                                    <div class="w-full inline-flex border-b">
                                        <div class="w-1/12 pt-2">
                                            <svg
                                                    fill="none"
                                                    class="w-6 text-gray-400 mx-auto"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                            >
                                                <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                                />
                                            </svg>
                                        </div>
                                        <input
                                                name="new_pass"
                                                type="password"
                                                class="w-11/12 focus:outline-none focus:text-gray-600 p-2 ml-4"
                                                placeholder="Nueva"
                                        />
                                    </div>
                                </div>
                                <!-- Boton actualizar-->
                                <div class="md:w-3/12 text-center md:pl-6">
                                    <input name="actualizar" value="Actualizar" type="submit"
                                           class="text-white w-full mx-auto max-w-sm rounded-md text-center bg-indigo-400 py-2 px-4 inline-flex items-center focus:outline-none md:float-right">
                                    <!-- <i class="fas fa-sync mr-2"></i>-->
                                    </input>
                                </div>
                                </form>
                            </div>

                            <hr/>
                            <!--ELiminar cuenta-->

                            <div class="w-full p-4 text-right text-gray-500 ">
                                <form id="delete_form" action="#" method="post">
                                    <button type="button" name="eliminar"
                                            class="inline-flex items-center focus:outline-none mr-4 hover:text-red-400"
                                            onclick="show_confirmation();">
                                        <svg
                                                fill="none"
                                                class="w-4 mr-2"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                        >
                                            <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                            />
                                        </svg>Borrar cuenta
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </section>


            </div>
        </div>
    </div>
<!--Alert-->
    <script type="text/javascript">
        function show_confirmation(){
           //let form = $(this).closest('#delete_form');
            let form = document.getElementById("#delete_form");
            Swal.fire({
                title: 'Cuidado',
                text: '¿Seguro que quieres eliminar la cuenta? Esta acción es definitiva.',
                icon: 'error',
                showConfirmButton: true,
                confirmButtonText: 'Confirmar',
                showCancelButton: true,
                cancelButtonText:"Me lo he pensado mejor"
            })
                .then(resultado =>{
                    if(resultado.value){
                        console.log("siiiii");
                        form.submit();
                    }else{
                        /*console.log("NOOOOOOOOOOOOOOOOO");*/
                    }
                })
        }


    </script>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
            crossorigin="anonymous"></script>

</body>
<!-- Footer -->
<!--<footer class="page-footer font-small">
    <div class="footer-copyright text-center py-3">© 2021 Copyright
        Isabel González Anzano
    </div>
</footer>-->
<!-- Footer -->
