<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

require_once $_SERVER['DOCUMENT_ROOT'] . "/Class/trello_api.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Class/PDF.php";

session_start();

//Autenticación
if ((!$_SESSION['user_id'])) {
    $login = "auth/login.php";
    header("Location: $login");
    exit;
}

// BD_____________________________________________________________________________________________
$bd_id = $_SESSION['user_id'];
//1º consulta datos en bd
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"], 1);
$active_group = 'default';
$query_builder = TRUE;

// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

if (mysqli_connect_errno()) {
    $msj = ("Falló la conexión con la base de datos: %s\n" . mysqli_connect_error());
    exit();
} else {
    $msj = "Conexión exitosa con la bd";
}
$consulta = "select * from users where id='$bd_id'";

if ($resultado = $conn->query($consulta)) {
    $arr_info = $resultado->fetch_array();
    $resultado->close();
}
$conn->close();
//fin BD__________________________________________________________________________________________________
$isFirstTimeWecame = true;


//Parámetros por defecto
$defaultUserName = $arr_info['username_trello'];
$defaultKey = $arr_info['key_trello'];
$defaultToken = $arr_info['token_trello'];
//$defaultBoardId = getFirstBoardId($defaultKey,$defaultToken) ?? null;

$defaultBoardId = $_POST['boardId'] ?? null;
//RUTAS
if (isset($_POST['reset'])) {
    delete_session_data();
    $user = "";
    $token = "";
    $key = "";

    $isFirstTimeWecame = true;
}
//Obtenemos las variables del formulario o usamos los valores por defecto;
if (isset($_POST['login'])) {
    $isFirstTimeWecame = false;
    $_SESSION['access_data']['key'] = $_POST['key'];
    $_SESSION['access_data']['token'] = $_POST['token'];
    $_SESSION['access_data']['user'] = $_POST['user'];
}
if (isset($_POST['submit']) == "Seleccionar") {
    if ($_SESSION['boardId'] != $_POST['board']) {

        $_SESSION['boardId'] = $_POST['board'];
    }
    $boardId = $_SESSION['boardId'];
}

$key = $_SESSION['access_data']['key'] ?? trim($defaultKey);
$token = $_SESSION['access_data']['token'] ?? trim($defaultToken);
$user = $_SESSION['access_data']['user'] ?? trim($defaultUserName);
$boardId = $_SESSION['boardId'] ?? $defaultBoardId;


//Consulta a los tableros:
$trello = new trello_api($key, $token);
$user_id_from_trello_api = $trello->request('GET', ("member/me/boards"));
$arr_tableros = board_request($trello, $user_id_from_trello_api);


//Consulta a las cards del tablero:
if ($boardId != null) {

//Comprobación de los filtros:
    $are_filters = check_filters();
    if ($are_filters == false) {
        $_SESSION['boardId'] = $boardId;
        $arr_cards[] = array();
        /*$columns = $trello->request('GET', ("boards/$boardId/lists"));*/
        $cards = $trello->request('GET', ("boards/{$boardId}/cards"));
        foreach ($cards as $index => $card) {
            $arr_labels = [];
            if ($card->labels != "") {
                foreach ($card->labels as $label) {
                    $arr_labels[] = array(
                        "name" => $label->name,
                        "color" => $label->color
                    );
                }
                $arr_cards[$card->id] = array(
                    "name" => $card->name,
                    "descripcion" => $card->desc ?? "",
                    "comentarios" => $card->badges->comments ?? "",
                    "url" => $card->url,
                    "fcreacion" => get_create_card_date($card->id),
                    "ffinalizacion" => parse_date_format($card->due),
                    "etiquetas" => $arr_labels
                );
            } else {
                $arr_cards[$card->id] = array(
                    "name" => $card->name,
                    "descripcion" => $card->desc ?? "",
                    "comentarios" => $card->badges->comments ?? "",
                    "url" => $card->url,
                    "fcreacion" => get_create_card_date($card->id),
                    "ffinalizacion" => parse_date_format($card->due),
                );
            }

        }
        //Eliminamos el primer elemento del array, que siempre viene vacío:
        $arr_cards = parse_array_cards($arr_cards);
    } else {
        //Obtenemos los filtros:
        $start_date_filter = $_SESSION['fstart'];
        $end_date_filter = $_SESSION['fend'];

        $_SESSION['boardId'] = $boardId;
        $arr_cards[] = array();
        $cards = $trello->request('GET', ("boards/{$boardId}/cards"));
        foreach ($cards as $index => $card) {
            $card_creation = get_create_card_date($card->id);
            $card_finalization = parse_date_format($card->due);

            $rango = check_in_range($start_date_filter, $end_date_filter, $card_creation);

            $arr_labels = [];
            if ($rango == true) {
                if ($card->labels != "") {
                    foreach ($card->labels as $label) {
                        $arr_labels[] = array(
                            "name" => $label->name,
                            "color" => $label->color
                        );
                    }
                    $arr_cards[$card->id] = array(
                        "name" => $card->name,
                        "descripcion" => $card->desc ?? "",
                        "comentarios" => $card->badges->comments ?? "",
                        "url" => $card->url,
                        "fcreacion" => get_create_card_date($card->id),
                        "ffinalizacion" => parse_date_format($card->due),
                        "etiquetas" => $arr_labels
                    );
                } else {
                    $arr_cards[$card->id] = array(
                        "name" => $card->name,
                        "descripcion" => $card->desc ?? "",
                        "comentarios" => $card->badges->comments ?? "",
                        "url" => $card->url,
                        "fcreacion" => $card_creation,
                        "ffinalizacion" => $card_finalization,
                    );
                }
            }


        }
        //Eliminamos el primer elemento del array, que siempre viene vacío:
        $arr_cards = parse_array_cards($arr_cards);
    }
    //FILTER SECTION:
    if (isset($_POST['submit']) && $_POST['submit'] == "Aplicar Filtros") {
        save_filters();
    }
    if (isset($_POST['submit']) && $_POST['submit'] == "Borrar Filtros") {
        delete_filters();
    }


    //DOWNLOAD SECTION:
    if (isset($_POST['submit']) && $_POST['submit'] == "Descargar JSON") {
        download_Json($arr_cards);
    }
    if (isset($_POST['submit']) && $_POST['submit'] == "Descargar PDF") {
        download_PDF($arr_cards);
    }

    /*    if (isset($_POST['submit']) && $_POST['submit'] == "Test PDF") {
            //Guardamos la info en sesion
            $arr_serialized = serialize($arr_cards);
            $_SESSION['data'] = $arr_serialized;
            header("Location: print_view.php");
            exit;
        }*/
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
    <!--<link href="https://unpkg.com/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">-->
    <!--Personal css-->
    <link rel="stylesheet" href="../css/style.css">
    <title>Consultas a tableros de Trello</title>
    <!--Favicon-->
    <link rel="icon" type="image/png" sizes="32x32" href="../img/icon.png">
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
            <h1 class="text-lg font-medium">
                <h1 style="text-align: center;"><i class="fab fa-trello text-primary"></i>
                    Consultas a tableros de Trello
                </h1>
                <span class="flex items-center justify-center h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-800">
                    <form action="quiensoy.php" method="post"
                          class="flex btn items-center justify-center h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-400">
                    <i class="fas fa-female fa-lg"></i>
                    <input type="submit" name="quiensoy" value="Sobre mí"
                           class="flex btn items-center justify-center text-gray-400  h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-400"/>
                </form>
                </span>
                <span class="flex items-center justify-center h-10 px-4  text-sm font-medium rounded hover:bg-gray-800">
                    <form action="contact.php" method="post"
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
            <div class="bg-cover bg-center border rounded-t-lg shadow-lg"
                 style="background-image: url(https://images.unsplash.com/photo-1572817519612-d8fadd929b00?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80)">

                <div class="grid grid-cols-3 gap-6">
                    <div class="h-24 col-span-1 bg-gray-700">
                        <div class="jumbotron" id="login-form">
                            <h1>Acceso a tableros - Login en Trello</h1>
                            <br>
                            <div class="container">
                                <form class="form-inline" action="report.php" method="post">
                                    <!--Usuario-->
                                    <div class="form-group mx-sm-3 mb-2 ">
                                        <label for="nombre">Usuario </label>
                                        <input class="form-control" name="user" type="text"
                                               placeholder=" <?= $user ?? null ?>"   value="<?php
                                        if($isFirstTimeWecame==true){
                                            echo $user;
                                        }else{
                                            echo "";
                                        }

                                        ?>" />
                                        <!--required-->
                                    </div>
                                    <!--Key-->
                                    <div class="form-group mx-sm-3 mb-2 ">
                                        <label for="key">Key </label>
                                        <input class="form-control" type="password" name="key"
                                               placeholder="<?= $key ?? null ?>"  value="<?php
                                        if($isFirstTimeWecame==true){
                                            echo $key;
                                        }else{
                                            echo "";
                                        }

                                        ?>" />
                                        <!--required-->
                                    </div>
                                    <!--Token-->
                                    <div class="form-group mx-sm-3 mb-2 ">
                                        <label for="token">Token </label>
                                        <input class="form-control" type="password" name="token"
                                               placeholder="<?= $token ?? null ?>" value="<?php
                                        if($isFirstTimeWecame==true){
                                            echo $token;
                                        }else{
                                            echo "";
                                        }

                                        ?>"
                                        />
                                        <!--required-->
                                    </div>
                                    <br/>
                                  <!--  Botones Login y Submit-->
                                    <div class="form-group" id="login_buttons">
                                        <input class="btn btn-primary btn-lg" type="submit" name="login" value="Login" />
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
                            if ($user_id_from_trello_api != null || $user_id_from_trello_api != "") {
                                if (isset($arr_cards) && $arr_cards != "") {
                                    echo "<h2>Previsualización</h2>";
                                    echo "<br/>";
                                    render_trello_header();
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
                                echo render_form_select_board($arr_tableros, $boardId, $arr_cards);
                                echo "</div>";
                            } else {
                                echo "No hay datos o no se ha logueado correctamente,por favor, intoduzca sus datos de acceso de Trello.";
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
