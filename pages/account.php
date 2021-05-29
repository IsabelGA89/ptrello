<?php
session_start();
/*if ((!$_SESSION['user_id'])) {
    $login = "./pages/auth/login.php";
    header("Location: $login");
    exit;
}*/

$email="ejemplo@gmail.com";
$username="ejemplo nick";
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
    <link rel="icon" type="image/png" sizes="32x32" href="img/icon.png">
    <!--ICONOS FONT AWESOME-->
    <script src="https://kit.fontawesome.com/b4f679ca0a.js" crossorigin="anonymous"></script>
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
           href="#">
            <i class="fas fa-file-alt fa-2x"></i>
        </a>

        <!--Informacion de cuenta-->
        <a class="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4  rounded hover:bg-gray-800"
           href="#">
            <i class="fas fa-id-card fa-2x"></i>
        </a>
    </div>

    <div class="flex flex-col flex-grow">
        <!--Header-->
        <div class="flex items-center flex-shrink-0 h-16 px-8 border-b border-gray-800">
            <h1 class="text-lg font-medium"><h1 style="text-align: center;"><i class="fab fa-trello text-primary"></i>
                    Consultas a tableros de Trello</h1>
                <form action="auth/login.php" method="post"
                      class="flex btn items-center justify-center h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-800">
                    <i class="fas fa-sign-out-alt fa-lg"></i><input type="submit" name="logout" value="Log out"
                                                                    class="flex btn items-center justify-center h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-800"/>
                </form>
        </div>
        <!--Body-->
        <div class="flex-grow p-6 overflow-auto bg-gray-800">
            <div class="bg-cover bg-center border rounded-t-lg shadow-lg"
                 style="background-image: url(https://images.unsplash.com/photo-1572817519612-d8fadd929b00?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80)">

                <section class="py-40 bg-gray-100 bg-opacity-50 h-screen">
                    <div class="mx-auto container max-w-2xl md:w-3/4 shadow-md">
                        <div class="bg-white space-y-6">
                            <!--Imagen y nombre-->
                            <div class="bg-gray-100 p-4 border-t-2 bg-opacity-5 border-indigo-400 rounded-t">
                                <div class="max-w-sm mx-auto md:w-full justify-items-center md:mx-0">
                                    <div class="inline-flex items-center space-x-4">
                                        <img
                                                class="w-10 h-10 object-cover rounded-full"
                                                alt="User avatar"
                                                src="../img/unnamed.png"
                                        />

                                        <h1 class="text-gray-600 ml-2"><?php echo $username ?></h1>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <!--Info cuenta-->
                            <div class="md:inline-flex space-y-4 md:space-y-0 w-full p-4 text-gray-500 items-center">
                                <h2 class="md:w-1/3 max-w-sm mx-auto">Información de la cuenta</h2>
                                <!--Email-->
                                <div class="md:w-2/3 max-w-sm mx-auto">
                                    <label class="text-sm text-gray-400">Email</label>
                                    <div class="w-full inline-flex border">
                                        <div class="pt-2 w-1/12 bg-gray-100 bg-opacity-50">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <input
                                                type="email"
                                                class="w-11/12 focus:outline-none focus:text-gray-600 p-2"
                                                placeholder="<?php echo $email ?>"
                                                disabled
                                        />
                                    </div>
                                </div>
                                <!--Username-->
                                <div class="md:w-2/3 mx-auto max-w-sm space-y-5">
                                    <div>
                                        <label class="text-sm text-gray-400">Username</label>
                                        <div class="w-full inline-flex border">
                                            <div class="w-1/12 pt-2 bg-gray-100">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <input
                                                    type="text"
                                                    class="w-11/12 focus:outline-none focus:text-gray-600 p-2"
                                                    placeholder="<?php echo $username ?>"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                           <!-- Cambiar contraseña-->
                            <div class="md:inline-flex w-full space-y-4 md:space-y-0 p-8 text-gray-500 items-center">
                                <h2 class="md:w-4/12 max-w-sm mx-auto">Cambiar contraseña</h2>

                                <div class="md:w-5/12 w-full md:pl-9 max-w-sm mx-auto space-y-5 md:inline-flex pl-2">
                                    <div class="w-full inline-flex border-b">
                                        <div class="w-1/12 pt-2">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                        <input
                                                type="password"
                                                class="w-11/12 focus:outline-none focus:text-gray-600 p-2 ml-4"
                                                placeholder="Nueva contraseña"
                                        />
                                    </div>
                                </div>

                                <div class="md:w-3/12 text-center md:pl-6">
                                    <button class="text-white w-full mx-auto max-w-sm rounded-md text-center bg-indigo-400 py-2 px-4 inline-flex items-center focus:outline-none md:float-right">
                                        <svg
                                                fill="none"
                                                class="w-4 text-white mr-2"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                        >
                                            <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                                            />
                                        </svg>
                                        Update
                                    </button>
                                </div>
                            </div>

                            <hr />
                            <!--Eliminar cuenta-->
                            <div class="w-full p-4 text-right text-gray-500">
                                <button class="inline-flex items-center focus:outline-none mr-4">
                                    <i class="fas fa-trash-alt"></i>
                                     Eliminar cuenta
                                </button>
                            </div>
                        </div>
                    </div>
                </section>


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
