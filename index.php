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
            <div class="bg-cover bg-center border rounded-t-lg shadow-lg" style="background-image: url(https://images.unsplash.com/photo-1572817519612-d8fadd929b00?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80)">


            <div class="container w-full md:max-w-3xl mx-auto pt-20">

                <div class="w-full px-4 md:px-6 text-xl text-gray-800 leading-normal"
                     style="font-family:Georgia,serif;">

                    <div class="jumbotron" id="information">
                        <h1>Listado de urls y datos necesarios</h1>
                        <div>
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
                        </div>
                        <div>
                            <hr/>
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
                            <hr/>
                           <!-- Boton a reportes-->
                            <div class="p-2 md:w-40 ">
                                <a href="pages/report.php" class="flex items-center p-4 bg-blue-200 rounded-lg shadow-xs cursor-pointer hover:bg-blue-500 hover:text-gray-100">
                                    <svg class="h-6 fill-current hover:text-gray-100 " viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>PHP icon</title><path d="M7.01 10.207h-.944l-.515 2.648h.838c.556 0 .97-.105 1.242-.314.272-.21.455-.559.55-1.049.092-.47.05-.802-.124-.995-.175-.193-.523-.29-1.047-.29zM12 5.688C5.373 5.688 0 8.514 0 12s5.373 6.313 12 6.313S24 15.486 24 12c0-3.486-5.373-6.312-12-6.312zm-3.26 7.451c-.261.25-.575.438-.917.551-.336.108-.765.164-1.285.164H5.357l-.327 1.681H3.652l1.23-6.326h2.65c.797 0 1.378.209 1.744.628.366.418.476 1.002.33 1.752a2.836 2.836 0 0 1-.305.847c-.143.255-.33.49-.561.703zm4.024.715l.543-2.799c.063-.318.039-.536-.068-.651-.107-.116-.336-.174-.687-.174H11.46l-.704 3.625H9.388l1.23-6.327h1.367l-.327 1.682h1.218c.767 0 1.295.134 1.586.401s.378.7.263 1.299l-.572 2.944h-1.389zm7.597-2.265a2.782 2.782 0 0 1-.305.847c-.143.255-.33.49-.561.703a2.44 2.44 0 0 1-.917.551c-.336.108-.765.164-1.286.164h-1.18l-.327 1.682h-1.378l1.23-6.326h2.649c.797 0 1.378.209 1.744.628.366.417.477 1.001.331 1.751zM17.766 10.207h-.943l-.516 2.648h.838c.557 0 .971-.105 1.242-.314.272-.21.455-.559.551-1.049.092-.47.049-.802-.125-.995s-.524-.29-1.047-.29z"/></svg>
                                    <div>
                                        <p class=" text-3xl font-medium ml-2 ">
                                            Ir a reportes
                                        </p>

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="jumbotron" id="trello">
                        <h1>Qué es Trello</h1>
                        <div>
                            <p>Trello es una aplicación online gratuita, que mediante un canvan ayuda a la gestión de
                                proyectos.
                                <a href="https://trello.com/c/RZExuHxu/6-qué-es-trello-y-cómo-se-usa">Aquí tiene parte
                                    de la documentación oficial.</a></p>
                            <p >
                                <iframe class="justify-items-start md:justify-items-center" width="560" height="315" src="https://www.youtube.com/embed/7XFAAZpQkbM"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </p>
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
