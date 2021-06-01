<!doctype html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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




<div class="flex items-center flex-shrink-0 h-16 px-8 border-b ">
    <h1 class="text-lg font-medium">
        <h1 style="text-align: center;"><i class="fab fa-trello text-primary"></i>
            Consultas a tableros de Trello
        </h1>
        <!--Quien soy-->
        <span class="flex items-center justify-center h-10 px-4 ml-auto text-sm font-medium rounded">
                    <form action="pages/quiensoy.php" method="post"
                          class="flex btn items-center justify-center h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-400">
                    <span style="color: white"><i class="fas fa-female fa-lg"></i></span>
                    <input type="submit" name="quiensoy" value="Sobre mí"
                           class="flex btn items-center justify-center text-white-50  h-10 px-4 ml-auto text-sm font-medium rounded"/>
                    </form>
                </span>
        <!--Contacto-->
        <span class="flex items-center justify-center h-10 px-4  text-sm font-medium rounded">
                    <form action="pages/contact.php" method="post"
                          class="flex btn items-center justify-center h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-400">
                        <span style="color: white"> <i class="fas fa-envelope fa-lg"></i></span>
                    <input type="submit" name="quiensoy" value="Cuentame cosas"
                           class="flex btn items-center justify-center text-white-50 h-10 px-4 ml-auto text-sm font-medium rounded "/>
                </form>
                </span>
        <!--LogOut-->
        <span class="flex items-center justify-center h-10 px-4 ml-2 text-sm font-medium rounded">
                    <form action="pages/auth/login.php" method="post"
                          class="flex btn items-center justify-center h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-400">
                    <span style="color: white"> <i class="fas fa-sign-out-alt fa-lg"></i></span>
                    <input type="submit" name="logout" value="Log out"
                           class="flex btn items-center justify-center text-white-50  h-10 px-4 ml-auto text-sm font-medium rounded"/>
                </form>
                </span>
</div>


</body>