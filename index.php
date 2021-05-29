<?php
require "./Class/trello_api.php";
require "./Class/PDF.php";

session_start();

if ((!$_SESSION['user_id'])) {
    $login = "./pages/auth/login.php";
    header("Location: $login");
    exit;
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
        <!--Info App-->
        <a class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4 rounded hover:bg-gray-800"
           href="index.php">
            <i class="fas fa-home fa-2x"></i>
        </a>
        <!--Quien Soy-->
        <a class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4 rounded hover:bg-gray-800"
           target="_blank" href="pages/quiensoy.php">
            <i class="fas fa-female fa-2x"></i>
        </a>
        <!--Report App-->
        <a class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4 rounded hover:bg-gray-800"
           href="pages/report.php">
            <i class="fas fa-file-alt fa-2x"></i>
        </a>

        <!--Informacion de cuenta-->
        <a class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4  rounded hover:bg-gray-800"
           href="pages/account.php">
            <i class="fas fa-id-card fa-2x"></i>
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
            <div class="bg-cover bg-center border rounded-t-lg shadow-lg"
                 style="background-image: url(https://images.unsplash.com/photo-1572817519612-d8fadd929b00?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80)">
                <div class="container w-full md:max-w-3xl mx-auto pt-20">

                    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md text-gray-100">
                            <!-- card header -->
                            <div class="px-6 py-4 bg-gray-800 border-b border-gray-600 font-bold uppercase">
                                Listado de urls y datos necesarios
                            </div>

                            <!-- card body -->
                            <div class="p-6 bg-gray-800 border-b border-gray-600">
                                <h3><a target="_blank" href="https://trello.com/app-key">Generar la api key </a></h3>
                                <h4><a target="_blank"
                                       href="https://developer.atlassian.com/cloud/trello/rest/api-group-actions/">
                                        Documentación API
                                        trello</a></h4>
                                <hr/>
                                <h5>Datos necesarios para utilizar la aplicación:</h5>
                                <ul>
                                    <li>Nombre de usuario de Trello</li>
                                    <li>Key (si no dispone de ella puede utilizar el enlace de arriba)</li>
                                    <li>Token (si no dispone de él puede utilizar el enlace de arriba)</li>
                                </ul>


                                <h5>Pasos para utilizar la aplicación:</h5>
                                <ol>
                                    <li>Rellene la sección de Login en función del tablero al que quiera acceder.</li>
                                    <li>Seleccione su tablero de la lista y presione el botón "Seleccionar"</li>
                                    <li>Se visualizará en el apartado de previsualización un listado con las cards de dicho
                                        tablero
                                    </li>
                                    <li>Puede descargar la versión en json de lo que le está mostrando la sección
                                        "Previsualización"
                                    </li>
                                    <li>Puede descargar la versión en pdf de lo que le está mostrando la sección
                                        "Previsualización"
                                    </li>
                                </ol>

                            </div>
                            <!-- card footer -->
                            <div class="p-6 bg-gray-800 border-gray-200 text-right">
                                <!-- button link -->
                                <a class="bg-blue-500 shadow-md text-sm text-white font-bold py-3 md:px-8 px-4 hover:bg-blue-400 rounded uppercase"
                                   href="pages/report.php">Ir a reportes</a>
                            </div>
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
