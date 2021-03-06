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
    <link rel="stylesheet" href="../css/reconocimientos.css">
    <title>Reconocimientos</title>
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
        <div class="flex items-center flex-shrink-0 h-16 px-8 border-b ">
            <h1 class="text-lg font-medium">
                <h1 style="text-align: center;"><i class="fab fa-trello text-primary"></i>
                    Consultas a tableros de Trello
                </h1>
                <!--Quien soy-->
                <span class="flex items-center justify-center h-10 px-4 ml-auto text-sm font-medium rounded">
                    <form action="quiensoy.php" method="post"
                          class="flex btn items-center justify-center h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-400">
                    <span style="color: white"><i class="fas fa-female fa-lg"></i></span>
                    <input type="submit" name="quiensoy" value="Sobre m??"
                           class="flex btn items-center justify-center text-white-50  h-10 px-4 ml-auto text-sm font-medium rounded"/>
                    </form>
                </span>
                <!--Contacto-->
                <span class="flex items-center justify-center h-10 px-4  text-sm font-medium rounded">
                    <form action="contact.php" method="post"
                          class="flex btn items-center justify-center h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-400">
                        <span style="color: white"> <i class="fas fa-envelope fa-lg"></i></span>
                    <input type="submit" name="quiensoy" value="Cuentame cosas"
                           class="flex btn items-center justify-center text-white-50 h-10 px-4 ml-auto text-sm font-medium rounded "/>
                </form>
                </span>
                <!--LogOut-->
                <span class="flex items-center justify-center h-10 px-4 ml-2 text-sm font-medium rounded">
                    <form action="auth/login.php" method="post"
                          class="flex btn items-center justify-center h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-400">
                    <span style="color: white"> <i class="fas fa-sign-out-alt fa-lg"></i></span>
                    <input type="submit" name="logout" value="Log out"
                           class="flex btn items-center justify-center text-white-50  h-10 px-4 ml-auto text-sm font-medium rounded"/>
                </form>
                </span>
        </div>
        <!--Body-->
        <div class="flex-grow p-6 overflow-auto bg-gray-800">
            <!--Cita-->
            <section class="component bg-gray-800 p-10 mx-1 md:mx-10 ">
                <blockquote class="relative text-2xl text-white text-center p-10 w-full m-1">
                    La gratitud es la menor de las virtudes, pero la ingratitud es el peor de los vicios.
                    <cite> - Thomas Fuller</cite>
                </blockquote>
            </section>
            <!--Reconocimientos-->
            <div class="w-full h-screen bg-center bg-no-repeat bg-cover  justify-center items-center" style="background-image: url('https://images.unsplash.com/photo-1609342475528-dd7d93e8311e?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=676&q=80');">
                <div class="w-full h-screen bg-opacity-50 bg-black flex justify-center items-center">
                    <div class="mx-4 text-center text-white">
                        <h1 class="font-bold text-6xl mb-4 mb-15">Muchas gracias por vuestra colaboraci??n</h1>
                        <h2 class="font-bold text-3xl mb-12">Carlos Sall??n - Beta tester</h2>
                        <h2 class="font-bold text-3xl mb-12">Sheila Cosculluela - QA, Beta tester</h2>
                        <h2 class="font-bold text-3xl mb-12">Cristina Gonz??lez -  Beta tester</h2>
                        <h2 class="font-bold text-3xl mb-12">Diego R??ndez - QA, Beta tester</h2>
                        <h2 class="font-bold text-3xl mb-12">Coronel Ping??ino - QA, Beta tester</h2>
                        <h2 class="font-bold text-3xl mb-12">Pilar Llamas - QA senior, Beta tester</h2>
                        <div>
                        </div>
                        <p>Si quieres colaborar, puedes ayudarnos contestando a <a class="underline text-blue-600 hover:text-blue-800 visited:text-purple-600" target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLSctQrpeHpU48KaJYJjBLWg7VgeD0L4iO-eTiLb5EkRkU6AN_w/viewform">esta encuesta</a>, no te llevar?? mas de un minuto .</p>
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
<!-- Footer -->
<!--<footer class="page-footer font-small">
    <div class="footer-copyright text-center py-3">?? 2021 Copyright
        Isabel Gonz??lez Anzano
    </div>
</footer>-->
<!-- Footer -->
