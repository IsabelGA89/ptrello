<?php
session_start();

//BD////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $datos['host']="localhost";
    $datos['user']="isa";
    $datos['password']="isa";
    $datos['bd']="proyecto";

    try {
        $connection = new BD_PDO($datos);
        $query = $connection->prepare("SELECT * FROM users WHERE EMAIL=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0) {
            echo '<p class="error">El email ya existe.</p>';
        }

        if ($query->rowCount() == 0) {
            $query = $connection->prepare("INSERT INTO users(USERNAME,PASSWORD,EMAIL) VALUES (:username,:password_hash,:email)");
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $result = $query->execute();

            if ($result) {
                header('Location:./index.php');
                exit;
            } else {
                echo '<p class="error">Algo ha ido mal.</p>';
            }
            $connection->cerrar();
        }
    } catch (PDOException $e) {
        echo '<p class="error">'.$e->getMessage().'</p>';
        $connection->cerrar();
    }

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
<section class="min-h-screen flex items-stretch text-white ">
    <div class="lg:flex w-1/2 hidden bg-gray-500 bg-no-repeat bg-cover relative items-center"
         style="background-image: url(https://images.unsplash.com/photo-1577495508048-b635879837f1?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=675&q=80);">
        <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
        <div class="w-full px-24 z-10">
            <h1 class="text-5xl font-bold text-left tracking-wide">Formulario de Registro</h1>
           <!-- <p class="text-3xl my-4"></p>-->
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
