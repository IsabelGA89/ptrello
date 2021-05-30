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
    <link rel="stylesheet" href="../css/style.css">
    <title>Cuenta</title>
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

<body>
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
                    <input type="submit" name="quiensoy" value="Quienes somos"
                           class="flex btn items-center justify-center text-gray-400  h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-400"/>
                </form>
                </span>
                <span class="flex items-center justify-center h-10 px-4 ml-2 text-sm font-medium bg-gray-800 rounded hover:bg-gray-700">
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
            <div class="heading text-center font-bold text-2xl m-5 text-gray-100">Video tutoriales</div>

            <div class="holder mx-auto  grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4">

                <div class="each mb-10 m-2 shadow-lg border-gray-800 bg-gray-100 ">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/7r9pYbtBEcE"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    <div class="desc p-4  text-gray-800">
                        <a href="https://www.youtube.com/watch?v=7r9pYbtBEcE" target="_new"
                           class="title font-bold block cursor-pointer hover:underline">Cuenta en Trello y Mi primer
                            Tablero</a>
                        <a href="#" target="_new"
                           class="badge bg-indigo-500 text-blue-100 rounded px-1 text-xs font-bold cursor-pointer">Formación</a>
                        <span class="description text-sm block py-2 border-gray-400 mb-2">Paso a paso para crear una cuenta en Trello y crear nuestros primeros tableros.</span>
                    </div>
                </div>
                <div class=" mb-10 m-2 bg-gray-800"></div>
                <div class="each mb-10 m-2 shadow-lg border-gray-800 bg-gray-100">
                    <!--<video width="500" height="500" controls>
                        <source src="../video/clave.mp4" type="video/mp4">
                    </video>-->
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/4RP6hIQZ93k"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    <div class="desc p-4 text-gray-800">
                        <a href="https://www.youtube.com/watch?v=4RP6hIQZ93k" target="_new"
                           class="title font-bold block cursor-pointer hover:underline">Como obtener las claves de
                            Trello</a>
                        <a href="#" target="_new"
                           class="badge bg-indigo-500 text-blue-100 rounded px-1 text-xs font-bold cursor-pointer">Formación</a>
                        <span class="description text-sm block py-2 border-gray-400 mb-2">Tutorial para obtener la api Key y el Token necesarios de trello para poder utilizar Trello Report</span>
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
    <!--Alert-->
    <script type="text/javascript">
        $("#button_delete").click(function (e) {
            e.preventDefault(); // Prevent the href from redirecting directly
            var form = document.getElementById("delete_form");
            show_confirmation(form);
        });

        function show_confirmation(form) {
            //var form = document.getElementById("delete_form");
            Swal.fire({
                title: 'Cuidado',
                text: '¿Seguro que quieres eliminar la cuenta? Esta acción es definitiva.',
                icon: 'error',
                showConfirmButton: true,
                confirmButtonText: 'Confirmar',
                showCancelButton: true,
                cancelButtonText: "Me lo he pensado mejor"
            })
                .then(resultado => {
                    if (resultado.value) {
                        form.method = "post";
                        form.action = "./account.php?delete=true";
                        form.submit();
                    }
                })
        }


    </script>
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
</html>