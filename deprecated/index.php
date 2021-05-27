<?php
/*require "functions.php";*/
require "classes/trello_api.php";
require "classes/PDF.php";
//require "print_pdf.php";

session_start();

//autenticación
/*if(!isset($_SESSION['user_id'])){
    header('Location: pages/login.php');
    exit;
}*/


// Test user acreditations :
$defaultUserName = "isabelgatfg";
$defaultKey = '46115a7dcf49746db66a0395e4bd1bee';
$defaultToken = "b2ce7110f3616705713bd97f12fc948dd51fbbbd32d49572fe618b1c463be4f7";

$defaultBoardId = $_POST['boardId'] ?? null;

if (isset($_POST['reset'])) {
    delete_session_data();
    $user = "";
    $token = "";
    $key = "";
}
//Obtenemos las variables del formulario o usamos los valores por defecto;
if (isset($_POST['login'])) {
    $_SESSION['access_data']['key'] = $_POST['key'];
    $_SESSION['access_data']['token'] = $_POST['token'];
    $_SESSION['access_data']['user'] = $_POST['user'];
}

if (isset($_POST['submit']) == "Seleccionar") {
    if($_SESSION['boardId'] != $_POST['board'] ){

        $_SESSION['boardId'] =  $_POST['board'];
    }
    $boardId = $_SESSION['boardId'];
}

$key = $_SESSION['access_data']['key'] ?? $defaultKey;
$token = $_SESSION['access_data']['token'] ?? $defaultToken;
$user = $_SESSION['access_data']['user'] ?? $defaultUserName;
$boardId = $_SESSION['boardId'] ?? $defaultBoardId;



//Consulta a los tableros:
$trello = new trello_api($key, $token);
$data = $trello->request('GET', ("member/me/boards"));
$arr_tableros = board_request($trello, $data);

//Consulta a las cards del tablero:
if ($boardId != null) {
    //Comprobación de los filtros:
    $are_filters = check_filters();

    if($are_filters == false){
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
    }else{
        //Obtenemos los filtros:
        $start_date_filter = $_SESSION['fstart'];
        $end_date_filter = $_SESSION['fend'];


        $_SESSION['boardId'] = $boardId;
        $arr_cards[] = array();
        $cards = $trello->request('GET', ("boards/{$boardId}/cards"));
        foreach ($cards as $index => $card) {
            $card_creation = get_create_card_date($card->id);
            $card_finalization =  parse_date_format($card->due);

            $rango = check_in_range($start_date_filter,$end_date_filter,$card_creation);

            $arr_labels = [];
            if($rango == true){
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
    <!--Personal css-->
    <link rel="stylesheet" href="../css/style.css">
    <title>Consultas a tableros de Trello</title>
    <!--Favicon-->
    <link rel="icon" type="image/png" sizes="32x32" href="../img/icon.png">
    <!--ICONOS FONT AWESOME-->
    <script src="https://kit.fontawesome.com/b4f679ca0a.js" crossorigin="anonymous"></script>
</head>
<header>
    <h1 style="text-align: center;"><i class="fab fa-trello text-primary"></i> Consultas a tableros de Trello</h1>
</header>
<body>
<div class="container">
    <div class="jumbotron" id="information">
        <h1>Listado de urls y datos necesarios</h1>
        <div>
            <h3><a href="https://trello.com/app-key">Generar la api key </a></h3>
            <h4><a href="https://developer.atlassian.com/cloud/trello/rest/api-group-actions/"> Documentación API
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
            <p>Puede dejar los valores por defecto y no hacer Login, en ese caso se utilizará el usuario por defecto
                <span style="color: darkblue"><?= $defaultUserName ?></span></p>
            <ol>
                <li>Rellene, o no, la sección de Login en función del tablero al que quiera acceder.</li>
                <li>Seleccione su tablero de la lista y presione el botón "Seleccionar"</li>
                <li>Se visualizará en fondo blanco un listado con las cards de dicho tablero</li>
                <li>Puede descargar la versión en json de lo que le está mostrando la sección "Previsualización"</li>
                <li>Puede descargar la versión en pdf de lo que le está mostrando la sección "Previsualización"</li>
            </ol>
        </div>
    </div>
    <div class="jumbotron" id="login-form">
        <h1>Login access data</h1>
        <br>
        <div class="container">
            <form class="form-inline" action="index.php" method="post">
                <div class="form-group mx-sm-3 mb-2 ">
                    <label for="nombre">Usuario </label>
                    <input class="form-control" name="user" type="text" placeholder=" <?= $user ?>" <!--required-->
                </div>
                <div class="form-group mx-sm-3 mb-2 ">
                    <label for="key">Key </label>
                    <input class="form-control" type="password" name="key" placeholder="<?= $key ?>" <!--required-->
                </div>
                <div class="form-group mx-sm-3 mb-2 ">
                    <label for="token">Token </label>
                    <input class="form-control" type="password" name="token" placeholder="<?= $token ?>"
                    <!--required-->
                </div>
                <br/>
                <div class="form-group" id="login_buttons">
                    <input class="btn btn-primary btn-lg" type="submit" name="login" value="Login">
                    <input class="btn btn-danger btn-lg" type="submit" name="reset"
                           value="Reiniciar Conexion" <?php if (!$_SESSION['access_data']) {
                        echo "disabled";
                    } ?> >
                </div>
            </form>
        </div>

    </div>
    <div class="jumbotron" id="application">
        <?php
        if ($data != null || $data != "") {
            if (isset($arr_cards) && $arr_cards != "") {
                echo "<h2>Previsualización</h2>";
                echo "<br/>";
                echo '<div class="bg-blue w-full p-8 flex justify-center font-sans">';
                echo "<div  id='cards-box'>";
                foreach ($arr_cards as $card){
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
            echo render_form_select_board($arr_tableros, $boardId,$arr_cards);
            echo "</div>";
        }
        ?>

        <!---->
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
<footer class="page-footer font-small">
    <div class="footer-copyright text-center py-3">© 2021 Copyright
        Isabel González Anzano
    </div>
</footer>
<!-- Footer -->
