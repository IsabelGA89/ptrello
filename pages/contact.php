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
