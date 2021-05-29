<?php
spl_autoload_register(function ($clase) {
    include 'classes/' . $clase . '.clase.php';
});
session_start();
$data ="";
/*if((!$_SESSION['user_id'])){
header('Location: pages/auth/login.php');
exit;
}*/


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
    <link href="https://unpkg.com/tailwindcss@0.3.0/dist/tailwind.min.css" rel="stylesheet">
    <!--Personal css-->
    <link rel="stylesheet" href="css/style.css">
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

<body>
<div class="flex w-screen h-screen text-gray-400 bg-gray-900">
    <!--Navbar-->
    <div class="flex flex-col items-center w-16 pb-4 overflow-auto border-r border-gray-800 text-gray-500">
        <!--Quien Soy-->
        <a class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4 rounded hover:bg-gray-800"
           target="_blank" href="pages/quiensoy.php">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
        </a>
        <!--Report App-->
        <a class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4 rounded hover:bg-gray-800"
           href="pages/report.php">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </a>
        <!--Informacion de cuenta-->
        <a class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4  rounded hover:bg-gray-800"
           href="#">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </a>
    </div>

    <div class="flex flex-col flex-grow">

        <!--Header-->
        <div class="flex items-center flex-shrink-0 h-16 px-8 border-b border-gray-800">
            <h1 class="text-lg font-medium"><h1 style="text-align: center;"><i class="fab fa-trello text-primary"></i>
                    Consultas a tableros de Trello</h1>
                <form action="pages/auth/login.php" method="post"
                      class="flex btn items-center justify-center h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-800">
                    <i class="fas fa-sign-out-alt"></i><input type="submit" name="logout" value="Log out"
                                                              class="flex btn items-center justify-center h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-800"/>
                </form>
        </div>
        <!--Body-->
        <div class="flex-grow p-6 overflow-auto bg-gray-800">
            <div class="bg-cover bg-center border rounded-t-lg shadow-lg" style="background-image: url(https://images.unsplash.com/photo-1572817519612-d8fadd929b00?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80)">

                <div class="grid grid-cols-3 gap-6">
                    <div class="h-24 col-span-1 bg-gray-700">
                        <div class="jumbotron" id="login-form">
                            <h1>Login access data</h1>
                            <br>
                            <div class="container">
                                <form class="form-inline" action="index.php" method="post">
                                    <div class="form-group mx-sm-3 mb-2 ">
                                        <label for="nombre">Usuario </label>
                                        <input class="form-control" name="user" type="text" placeholder=" <?= $user ?? null ?>"
                                        <!--required-->
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2 ">
                                        <label for="key">Key </label>
                                        <input class="form-control" type="password" name="key" placeholder="<?= $key ?? null ?>"
                                        <!--required-->
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2 ">
                                        <label for="token">Token </label>
                                        <input class="form-control" type="password" name="token" placeholder="<?= $token?? null ?>"
                                        <!--required-->
                                    </div>
                                    <br/>
                                    <div class="form-group" id="login_buttons">
                                        <input class="btn btn-primary btn-lg" type="submit" name="login" value="Login">
                                        <input class="btn btn-danger btn-lg" type="submit" name="reset"
                                               value="Reiniciar Conexion"
                                            <?php if (!$_SESSION['access_data']) {
                                                echo "disabled";
                                            } ?> />
                                    </div>
                                </form>
                            </div>

                        </div>
                        <div class="jumbotron" id="application">
                            <?php

                            if ($data != null || $data != "") {
                                if (isset($arr_cards) && $arr_cards != "") {
                                    echo "<h2>Previsualización</h2>";
                                    echo "<br/>";
                                    echo '<div class="bg-blue w-full p-8 flex justify-center font-sans">';
                                    echo "<div  id='cards-box'>";
                                    foreach ($arr_cards as $card) {
                                        render_card($card);
                                    }
                                    echo "</div>";
                                    echo "</div>";
                                }
                                ?>
                                <?php
                                echo "<hr/>";
                                echo "<div class='container' id='select-board-section'>";
                                echo "<h2>Seleccione su tablero</h2>";
                                echo "<br/>";
                                   /* echo render_form_select_board($arr_tableros, $boardId, $arr_cards);*/
                                echo "</div>";
                            }
                            ?>

                            <!---->
                        </div>
                    </div>
                </div>



            </div>
        </div>


    </div>
</div>
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