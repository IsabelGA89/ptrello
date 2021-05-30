<?php
session_start();

if ((!$_SESSION['user_id'])) {
    $login = "./auth/login.php";
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
    <link rel="stylesheet" href="../css/faqs.css">
    <title>FAQs</title>
    <!--Favicon-->
    <link rel="icon" type="image/png" sizes="32x32" href="../img/icon.png">
    <!--ICONOS FONT AWESOME-->
    <script src="https://kit.fontawesome.com/b4f679ca0a.js" crossorigin="anonymous"></script>
    <!--SweetAlert-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../libs/sweetalert2.all.min.js"></script>
    <!--Tooltips-->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
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
            <button type="button" data-title='Inicio' data-placement="right" class=" text-gray-200 rounded hover:bg-blue-500 px-4 py-2 focus:outline-none">
                <i  class="fas fa-home fa-lg"></i>
            </button>
        </a>
        <!--Report App-->
        <a class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4 rounded hover:bg-gray-800"
           href="report.php">
            <button type="button" data-title='Reportes' data-placement="right" class=" text-gray-200 rounded hover:bg-blue-500 px-4 py-2 focus:outline-none">
                <i class="fas fa-file-alt fa-lg"></i>
            </button>
        </a>
        <!--Informacion de cuenta-->
        <a class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4  rounded hover:bg-gray-800"
           href="account.php">
            <button type="button" data-title='Cuenta' data-placement="right" class=" text-gray-200 rounded hover:bg-blue-500 px-4 py-2 focus:outline-none">
                <i class="fas fa-user-circle fa-lg"></i>
            </button>
        </a>
        <!--Reconocmiento-->
        <a class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4  rounded hover:bg-gray-800"
           href="reconocimientos.php">
            <button type="button" data-title='Reconocimientos' data-placement="right" class=" text-gray-200 rounded hover:bg-blue-500 px-4 py-2 focus:outline-none">
                <i class="fas fa-chess-rook fa-lg"></i>
            </button>
        </a>
        <!--FAQs-->
        <a class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4  rounded hover:bg-gray-800"
           href="faq.php">
            <button type="button" data-title='FAQ' data-placement="right" class=" text-gray-200 rounded hover:bg-blue-500 px-4 py-2 focus:outline-none">
                <i class="fas fa-question-circle fa-lg"></i>
            </button>
        </a>
        <!--VideoTutoriales-->
        <a class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4  rounded hover:bg-gray-800"
           href="tutorial.php">
            <button type="button" data-title='VideoTutoriales' data-placement="right" class=" text-gray-200 rounded hover:bg-blue-500 px-4 py-2 focus:outline-none">
                <i class="fab fa-youtube fa-lg"></i>
            </button>
        </a>
    </div>

    <div class="flex flex-col flex-grow">
        <!--Header-->
        <div class="flex items-center flex-shrink-0 h-16 px-8 border-b border-gray-800">
            <h1 class="text-3xl font-medium">
                <h1 style="text-align: center;"><i class="fab fa-trello text-primary"></i>
                    Consultas a tableros de Trello
                </h1>
                <span class="flex items-center justify-center h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-800">
                    <form action="quiensoy.php" method="post" target="_blank"
                          class="flex btn items-center justify-center h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-400">
                    <i class="fas fa-female fa-lg"></i>
                    <input type="submit" name="quiensoy" value="Sobre mí"
                           class="flex btn items-center justify-center text-gray-400  h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-400"/>
                </form>
                </span>
                <span class="flex items-center justify-center h-10 px-4  text-sm font-medium rounded hover:bg-gray-800">
                    <form action="contact.php" method="post" target="_blank"
                          class="flex btn items-center justify-center h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-400">
                        <i class="fas fa-envelope fa-lg"></i>
                    <input type="submit" name="quiensoy" value="Cuentame cosas"
                           class="flex btn items-center justify-center text-gray-400  h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-400"/>
                </form>
                </span>
                <span class="flex items-center justify-center h-10 px-4 ml-2 text-sm font-medium rounded hover:bg-gray-800">
                    <form action="auth/login.php" method="post"
                          class="flex btn items-center justify-center h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-400">
                    <i class="fas fa-sign-out-alt fa-lg"></i>
                    <input type="submit" name="logout" value="Log out"
                           class="flex btn items-center justify-center text-gray-400  h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-400"/>
                </form>
                </span>
        </div>
        <!--Body-->
        <div class="flex-grow p-6 overflow-auto bg-gray-800">
            <!--FAQ-->
            <div class="bg-gray-100 pt-10">
                <div class="mx-auto max-w-6xl">
                    <div class="p-2 bg-gray-100 rounded">
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-1/3 p-4 text-sm">
                                <div class="text-3xl">Sección <span class="font-medium">FAQ</span></div>
                                <div class="my-2">¿Cómo funciona esta aplicación?</div>
                                <div class="mb-2">¿Para qué sirve?</div>
                                <div class="text-xs text-gray-600">Revisa la sección para dar respuesta a tus dudas.
                                </div>
                            </div>
                            <div class="md:w-2/3">
                                <div class="p-4">
                                    <!--Question-->
                                    <div class="mb-2">
                                        <div class="font-medium rounded-sm text-lg px-2 py-3 flex text-gray-800 flex-row-reverse mt-2 text-black bg-white hover:bg-white">
                                            <div class="flex-auto">¿Qué es Trello Report?</div>
                                        </div>
                                        <div class="p-2 text-justify text-left text-gray-800 mb-5 bg-white" style="">
                                            Trello Report nace como una respuesta para las personas que necesitan
                                            obtener información de forma rápida y automatizada
                                            de la tarjetas creadas en Trello, la famosa aplicación de gestión de tareas
                                            gratuita.
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="font-medium rounded-sm text-lg px-2 py-3 flex text-gray-800 flex-row-reverse mt-2 text-black bg-white hover:bg-white">
                                            <div class="flex-auto">¿Cómo se utiliza?</div>
                                        </div>
                                        <div class="p-2 text-justify text-left text-gray-800 mb-5 bg-white" style="">
                                            Para trabajar con Trello Report, simplemente tienes que ir al apartado de
                                            Reports desde la cinta de opciones situada a la izquierda
                                            y loguearte en Trello para poder seleccionar los tableros y descargar la
                                            información.
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="font-medium rounded-sm text-lg px-2 py-3 flex text-gray-800 flex-row-reverse mt-2 text-black bg-white hover:bg-white">
                                            <div class="flex-auto">Pasos a seguir</div>
                                        </div>
                                        <div class="p-2 text-justify text-left text-gray-800 mb-5 bg-white" style="">
                                            <ol class="list-decimal ml-4">
                                                <li>Si no dispones de una cuenta en Trello, debes hacerte una y crear tu
                                                    primer tablero, con algunas tarjetas para poder probarlo todo.
                                                    <a class="underline text-blue-600 hover:text-blue-800 visited:text-purple-600"
                                                       target="_blank"
                                                       href="https://www.genbeta.com/guia-de-inicio/como-usar-trello-para-organizar-tu-trabajo-tu-vida">En
                                                        esta guía te explican cómo hacerlo.</a></li>
                                                <li>Siguiendo los enlaces que aparecen en la página principal, obtener
                                                    tu token y tu clave de acceso.
                                                </li>
                                                <li>Acceder a la aplicaión Trello Report, en la sección Reports</li>
                                                <li>Introducir los datos de username,token y clave en el apartado Login
                                                    en Trello y darle al botón de Login
                                                </li>
                                                <li>Seleccionar el tablero</li>
                                                <li>Descargar la información en el formato deseado.</li>
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="font-medium rounded-sm text-lg px-2 py-3 flex text-gray-800 flex-row-reverse mt-2 text-black bg-white hover:bg-white">
                                            <div class="flex-auto">¿Son lo mismo Trello y Trello Report?</div>
                                        </div>
                                        <div class="p-2 text-justify text-left text-gray-800 mb-5 bg-white" style="">
                                            No, Trello es una aplicación ajena a esta, sin embargo, Trello Report sí utiliza la información que cede Trello para generar los
                                            informes, es por este motivo que es necesario loguearse como usuario de Trello además de usuario de esta aplicación.
                                        </div>
                                    </div>
                                    <!--Card trello-->
                                    <div class="max-w-2xl mt-5 mx-auto sm:px-6 lg:px-8">
                                        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                                            <div class="overflow-hidden shadow-md text-gray-100">
                                                <!-- card header -->
                                                <div class=" text-3xl px-6 py-4 bg-gray-800 border-b border-gray-600 font-bold uppercase">
                                                    Qué es Trello
                                                </div>

                                                <!-- card body -->
                                                <div class="p-6 bg-gray-800 border-b border-gray-600">
                                                    <p>Trello es una aplicación online gratuita, que mediante un canvan ayuda a la
                                                        gestión de
                                                        proyectos.
                                                        <a class="underline text-blue-600 hover:text-blue-800 visited:text-purple-600" target="_blank" href="https://trello.com/c/RZExuHxu/6-qué-es-trello-y-cómo-se-usa">Aquí tiene
                                                            parte
                                                            de la documentación oficial.</a></p>
                                                    <p>
                                                        <iframe class="justify-items-start md:justify-items-center" width="560"
                                                                height="315" src="https://www.youtube.com/embed/7XFAAZpQkbM"
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
    <!--Tooltips-->
    <script>
        tippy('button', {
            content: (reference) => reference.getAttribute('data-title'),
            onMount(instance) {
                instance.popperInstance.setOptions({
                    placement: instance.reference.getAttribute('data-placement')
                });
            }
        });
    </script>

</body>

