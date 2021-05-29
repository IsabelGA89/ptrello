<?php
session_start();
$msj = "";
$error="";

//BD////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

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
        $msj =("Falló la conexión con la base de datos: %s\n". mysqli_connect_error());
        exit();
    }else{
        $msj = "Conexión exitosa con la bd";
    }

    $consulta_email = "SELECT * FROM users WHERE EMAIL='j@gmail.com'";

    if ($resultado = $conn->query($consulta_email)) {
        /* obtener el array de objetos */
        $obj = $resultado->fetch_array();
        if($obj === null){
            //el email no existe insertamos:
            $query = "INSERT INTO users(username,password,email) VALUES ('$username','$password_hash','$email')";
            if ($conn->query($query) === TRUE) {
                $info = "Usuario creado correctamente, ya puede usar sus nuevas credenciales para acceder a la aplicación.";
            } else {
                $error = "Error: $conn->error";
            }
        }else{
            $error = "El email introducido ya existe en el sistema, pruebe con otro";
        }
        $resultado->close();
    }
    /* cerrar la conexión */
    $conn->close();


}
/////////////////////////////////////////////////////////////////////////////////
?>
<!doctype html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport"
    <!--Tailwindcss & daisy-->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1/dist/tailwind.min.css" rel="stylesheet" type="text/css"/>
    <!--Favicon-->
    <link rel="icon" type="image/png" sizes="32x32" href="img/icon.png">
    <!--ICONOS FONT AWESOME-->
    <script src="https://kit.fontawesome.com/b4f679ca0a.js" crossorigin="anonymous"></script>
</head>


<body>
<?php
if($error != ""){
    ?>
    <!--Msj section-->
    <div class="block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
          <span class="mr-1">
            <svg class="fill-current text-red-500 inline-block h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
              <path class="heroicon-ui" d="M15 19a3 3 0 0 1-6 0H4a1 1 0 0 1 0-2h1v-6a7 7 0 0 1 4.02-6.34 3 3 0 0 1 5.96 0A7 7 0 0 1 19 11v6h1a1 1 0 0 1 0 2h-5zm-4 0a1 1 0 0 0 2 0h-2zm0-12.9A5 5 0 0 0 7 11v6h10v-6a5 5 0 0 0-4-4.9V5a1 1 0 0 0-2 0v1.1z"/>
            </svg>
          </span>
        <span>
           <?php
           if($error != ""){
               echo $error;
           } ?>
          </span>
    </div>
    <?php
}
?>
<section class="min-h-screen flex items-stretch text-white ">
    <div class="lg:flex w-1/2 hidden bg-gray-500 bg-no-repeat bg-cover relative items-center"
         style="background-image: url(https://images.unsplash.com/photo-1577495508048-b635879837f1?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=675&q=80);">
        <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
        <div class="w-full px-24 z-10">
            <h1 class="text-5xl font-bold text-left tracking-wide">Formulario de Registro</h1>
            <div class="py-6 space-x-2">
                <?php
                if($msj != ""){
                    echo $msj;
                }
                ?>
            </div>
        </div>
    </div>
    <div class="lg:w-1/2 w-full flex items-center justify-center text-center md:px-16 px-0 z-0"
         style="background-color: #161616;">
        <div class="absolute lg:hidden z-10 inset-0 bg-gray-500 bg-no-repeat bg-cover items-center"
             style="background-image: url(https://images.unsplash.com/photo-1577495508048-b635879837f1?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=675&q=80);">
            <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
        </div>
        <div class="w-full py-6 z-20">
            <h1 class="my-6">
                <span class="text-5xl font-bold text-left tracking-wide">Trello Report</span>
            </h1>
            <p class="text-gray-100">
                Rellena el formulario
            </p>
            <form method="post" action="" name="signup-form" class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto">
                <div class="pb-2 pt-4">
                    <input type="text" name="username" pattern="[a-zA-Z0-9]+" required placeholder="Username"
                           class="block w-full p-4 text-lg rounded-sm bg-black">
                </div>
                <div class="pb-2 pt-4">
                    <input  type="email" name="email" required placeholder="Email"
                           class="block w-full p-4 text-lg rounded-sm bg-black">
                </div>
                <div class="pb-2 pt-4">
                    <input class="block w-full p-4 text-lg rounded-sm bg-black" type="password" name="password"
                           id="password" required placeholder="Password">
                </div>
                <div class="px-4 pb-2 pt-4">
                    <input type="submit" name="register" value="registro" class="uppercase w-1/2 p-2 text-lg rounded-full bg-green-500 hover:bg-green-600 focus:outline-none"/>
                </div>
            </form>
            <form method="post" action="login.php">
                <div class="px-4 pb-2 pt-4">
                    <input type="submit" name="back" value="volver a login" class="uppercase w-1/2 p-2 text-lg rounded-full bg-indigo-500 hover:bg-indigo-600 focus:outline-none"/>
                </div>
            </form>
        </div>
    </div>
</section>
</body>

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
<!-- Footer -->
<footer class="page-footer font-small text-gray-600 body-font">
    <div class="footer-copyright text-center py-3">© 2021 Copyright
        Isabel González Anzano
    </div>
</footer>
<!-- Footer -->
