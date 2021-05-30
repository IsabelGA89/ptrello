<?php

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
        <!--Reconocmiento-->
        <a class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4  rounded hover:bg-gray-800"
           href="reconocimientos.php">
            <i class="fas fa-chess-rook fa-2x"></i>
        </a>
        <!--FAQs-->
        <a class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4  rounded hover:bg-gray-800"
           href="faq.php">
            <i class="fas fa-question-circle fa-2x"></i>
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

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <!--Contact us-->
            <div class="flex items-center min-h-screen bg-gray-50 dark:bg-gray-900">
                <div class="container mx-auto">
                    <div class="max-w-md mx-auto my-10 bg-white p-5 rounded-md shadow-sm">
                        <div class="text-center">
                            <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200">¿Tienes más
                                preguntas?</h1>
                            <p class="text-gray-400 dark:text-gray-400">Contacta con nosotros</p>
                        </div>
                        <div class="m-7">
                            <form action="https://api.web3forms.com/submit" method="POST" id="form">

                                <input type="hidden" name="apikey" value="b4728622-30f9-4197-9d75-f4c6d4751501">
                                <input type="hidden" name="subject" value="New Submission from Web3Forms">
                                <input type="checkbox" name="botcheck" id="" style="display: none;">


                                <div class="mb-6">
                                    <label for="name" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Nombre
                                        Completo</label>
                                    <input type="text" name="name" id="name" placeholder="Reith Ress" required
                                           class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500"/>
                                </div>
                                <div class="mb-6">
                                    <label for="email" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Email</label>
                                    <input type="email" name="email" id="email" placeholder="you@company.com" required
                                           class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500"/>
                                </div>
                               <!-- <div class="mb-6">

                                    <label for="phone" class="text-sm text-gray-600 dark:text-gray-400">Phone
                                        Number</label>
                                    <input type="text" name="phone" id="phone" placeholder="+1 (555) 1234-567" required
                                           class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500"/>
                                </div>-->
                                <div class="mb-6">
                                    <label for="message" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Tu mensaje</label>

                                    <textarea rows="5" name="message" id="message" placeholder="Cuéntanos tus dudas :3"
                                              class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500"
                                              required></textarea>
                                </div>
                                <div class="mb-6">
                                    <button type="submit"
                                            class="w-full px-3 py-4 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">
                                       Enviar Mensaje
                                    </button>
                                </div>
                                <p class="text-base text-center text-gray-400" id="result">
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                const form = document.getElementById('form');
                const result = document.getElementById('result');

                form.addEventListener('submit', function(e) {
                    const formData = new FormData(form);
                    e.preventDefault();
                    var object = {};
                    formData.forEach((value, key) => {
                        object[key] = value
                    });
                    var json = JSON.stringify(object);
                    result.innerHTML = "Por favor, espere..."

                    fetch('https://api.web3forms.com/submit', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: json
                    })
                        .then(async (response) => {
                            let json = await response.json();
                            if (response.status == 200) {
                                result.innerHTML = json.message;
                                result.classList.remove('text-gray-500');
                                result.classList.add('text-green-500');
                            } else {
                                console.log(response);
                                result.innerHTML = json.message;
                                result.classList.remove('text-gray-500');
                                result.classList.add('text-red-500');
                            }
                        })
                        .catch(error => {
                            console.log(error);
                            result.innerHTML = "¡Se ha roto algo!";
                        })
                        .then(function() {
                            form.reset();
                            setTimeout(() => {
                                result.style.display = "none";
                            }, 5000);
                        });
                })
            </script>

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
