<?php
$characterMap = 'àáãâçêéíîóõôúÀÁÃÂÇÊÉÍÎÓÕÔÚ';

//FUNCTIONS
//Sessions:
function delete_session_data()
{
    if (isset($_SESSION['access_data'])) {
        session_destroy();
    }
}

//Guarda en variables de sesión los filtros asignados
function save_filters()
{
    //Fecha inicio
    if (isset($_POST['fstart']) && $_POST['fstart'] != "") {
        $_SESSION['fstart'] = parse_date_format($_POST['fstart']);

    }
    //Fecha fin
    if (isset($_POST['fend']) && $_POST['fend'] != "") {
        $_SESSION['fend'] = parse_date_format($_POST['fend']);

    }

}

function delete_filters()
{
    unset($_SESSION['fstart']);
    unset($_SESSION['fend']);
    unset($_POST['fstart']);
    unset($_POST['fend']);

}

function check_filters()
{
    if (isset($_SESSION['fstart']) && isset($_SESSION['fend'])) {
        return true;
    } else {
        return false;
    }
}

//Time functions: +**************************************
function parse_date_format($date)
{
    return date_format(date_create($date), 'd/m/Y');
}

function get_create_card_date($cardID)
{
    $createdDate = date('r', hexdec(substr($cardID, 0, 8)));
    return parse_date_format($createdDate);
}

function date_to_timestamp($date)
{
    $d = DateTime::createFromFormat("d/m/Y", "$date");
    if ($d === false) {
        die("Incorrect date string");
    } else {
        return $d->getTimestamp();
    }
}

//https://www.jose-aguilar.com/blog/comparar-fechas-con-php/
function compararFechas($primera, $segunda)
{
    $valoresPrimera = explode("/", $primera);
    $valoresSegunda = explode("/", $segunda);

    $diaPrimera = $valoresPrimera[0];
    $mesPrimera = $valoresPrimera[1];
    $anyoPrimera = $valoresPrimera[2];

    $diaSegunda = $valoresSegunda[0];
    $mesSegunda = $valoresSegunda[1];
    $anyoSegunda = $valoresSegunda[2];

    $diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);
    $diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);

    if (!checkdate($mesPrimera, $diaPrimera, $anyoPrimera)) {
        // "La fecha ".$primera." no es v&aacute;lida";
        return 0;
    } elseif (!checkdate($mesSegunda, $diaSegunda, $anyoSegunda)) {
        // "La fecha ".$segunda." no es v&aacute;lida";
        return 0;
    } else {
        return $diasPrimeraJuliano - $diasSegundaJuliano;
    }

}

function check_in_range($fecha_inicio, $fecha_fin, $fecha)
{

    $fecha_inicio = strtotime($fecha_inicio);
    $fecha_fin = strtotime($fecha_fin);
    $fecha = strtotime($fecha);

    if (($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin)) {
       //echo "$fecha Entra en rango <br/>";
        return true;

    } else {
        //echo "$fecha NO entra en rango<br/>";
        return false;

    }
}

//Render functions:************************************************************************************
//renderiza el formulario con el select y los nombres de los tableros, devuelve el id al seleccionar uno.
function render_form_select_board($arr_tableros, $boardId = null, $arr_cards = null)
{
    $html = "";
    $html .= '<div class="container">';
    $html .= '<form class="form-inline" action="index.php" method="post">';
    $html .= '<div class="form-group mx-sm-3 mb-2">';
    $html .= '<select class="form-control" name="board" required>';
    /* Si ya hay un tablero seleccinado se guarde y se muestra seleccionado*/
    if ($boardId != null) {
        foreach ($arr_tableros as $tablero => $id) {
            if ($id == $boardId) {
                $html .= "<option selected='selected' value='" . $id . "'> $tablero</option>";
            } else {
                $html .= "<option value='" . $id . "'> $tablero</option>";
            }
        }
    } else {
        foreach ($arr_tableros as $tablero => $id) {
            $html .= "<option value='" . $id . "'> $tablero</option>";
        }
    }
    $html .= "</select>";
    $html .= '<input style="margin: 15px;" class="btn-lg btn btn-primary" type="submit" name="submit" value="Seleccionar">';
    $html .= "</div>";
    /* BOTONES DE DESCARGA*/
    if ($boardId != null) {
        $html .= "<div class='form-group form-inline'>";
        /* $html .= '<input style="margin: 15px;" class="btn btn-info" type="submit" name="submit" value="Descargar CSV">';*/
        $html .= '<input style="margin: 15px;" class="btn-lg btn btn-secondary" type="submit" name="submit" value="Descargar JSON">';
        $html .= '<input style="margin: 15px;" class="btn-lg btn btn-danger" type="submit" name="submit" formtarget="_blank" value="Descargar PDF">';
        /* $html .= '<input style="margin: 15px;" class="btn-lg btn btn-info" type="submit" name="submit" formtarget="_blank" value="Test PDF">';*/
        $html .= "</div>";
    }
    /*FILTROS*/
    if ($arr_cards != null || sizeof($arr_cards) > 1) {
        $html .= render_filters($arr_cards);
    }
    $html .= "</form>";
    $html .= "</div>";

    return $html;
}

function render_filters($arr_cards)
{
    //Como la lista de cards viene ordenada de más antigua a más actual
    $key_first_element = array_key_first($arr_cards);
    $fd = $arr_cards[$key_first_element]["fcreacion"];
    $first_date = date_to_timestamp($fd);
    $first_date = date("Y-m-d", $first_date);


    //Filtros:
    $html = "";
    $html .= '<hr/>';
    $html .= '<div class="container">';
    /* $html .= '<form class="form-inline" action="index.php" method="post">';*/
    $html .= "<h3>Filtros</h3>";
    $html .= '<div class="form-group mx-sm-3 mb-2">';
    $html .= "<label for='fstart'>Fecha Inicio:</label>";
    $html .= "<input type='date' id='fstart' name='fstart' value='" . $first_date . "' >";
    $html .= "<label for='fend'>Fecha Fin:</label>";
    $today = date("Y-m-d");
    $html .= "<input type='date'  id='fend' name='fend' value='" . $today . "' ";
    $html .= "</div>";
    $html .= '<input style="margin: 15px;" class="btn-lg btn btn-success" type="submit" name="submit" value="Aplicar Filtros">';
    $html .= '<input style="margin: 15px;" class="btn-lg btn btn-danger" type="submit" name="submit" value="Borrar Filtros">';
    /* $html .= "</form>";*/
    $html .= "</div>";

    return $html;
}

//renderiza un componente tarjeta
function render_card($data)
{
    echo '<div class="rounded bg-grey-light w-64 p-2" >';
    echo '<div class="flex justify-between py-1" >';
        echo $data['name'];
    echo '</div >';
    echo '<div class="text-sm mt-2" >';

    echo '<div class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter" >';
        echo $data['descripcion'];
    echo '<div class="text-grey-darker mt-2 ml-2 flex justify-between items-start">';
    echo '<span class="text-xs flex items-center" >';
    if(is_array($data['etiquetas']) && $data['etiquetas'] >1){
        foreach ($data['etiquetas'] as $tag){
            echo '<span class="inline-block rounded-full text-white bg-indigo-500 px-2 py-1 text-xs font-bold mr-3">'.$tag.'</span>';
        }
    }
    echo "</span>";
    echo "</div>";
    echo "</div>";

    echo "</div>";
    echo "</div>";
    echo "<br/>";

}


//DOWNLOAD functions: ******************************************
// function download_CSV($arr_cards){
//     $time = date("Y/m/d h:i:sa");
//     $fileName = "cards_$time.csv";
//
//     ob_clean();
//     header('Pragma: public');
//     header('Expires: 0');
//     header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
//     header('Cache-Control: private', false);
//     header('Content-Type: text/csv');
//     header('Content-Disposition: attachment;filename=' . $fileName);
//
//     if(isset($arr_cards['0'])){
//         $fp = fopen('php://output', 'w');
//         fputcsv($fp, array_keys($arr_cards['0']));
//         foreach($arr_cards as $values){
//             fputcsv($fp, $values);
//         }
//         fclose($fp);
//     }
//     ob_flush();
// }
// function download_CSV2($arr_cards){
//
//     $time = date("Y/m/d h:i:sa");
//     $fileName = "cards-$time.csv";
//
//     ob_clean();
//     header('Pragma: public');
//     header('Expires: 0');
//     header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
//     header('Cache-Control: private', false);
//     header('Content-Type: text/csv');
//     header('Content-Disposition: attachment;filename=' . $fileName);
//
//     if(isset($arr_cards['0'])){
//         $fp = fopen('php://output', 'w');
//         fputcsv($fp, array_keys($arr_cards['0']));
//         foreach($arr_cards as $values){
//             fputcsv($fp, $values);
//         }
//         fclose($fp);
//     }
//     ob_flush();
// }
//funcional
function download_Json($arr_cards)
{
    $json_cards = json_encode($arr_cards);
    $filename = 'cards_json_' . date('Y-m-d_h:i:sa');
    header("Content-type: application/vnd.ms-excel");
    header("Content-Type: application/force-download");
    header("Content-Type: application/download");
    header("Content-disposition: " . $filename . ".json");
    header("Content-disposition: filename=" . $filename . ".json");
    print $json_cards;
    exit;
}


//Debug functions:
function mostrar_warnings()
{
    ini_set("display_errors", true);
    error_reporting(E_ALL);
}

function imprime_sesiones()
{
    if (isset($_SESSION)) {
        echo '<pre>';
        echo htmlspecialchars(print_r($_SESSION, true));
        echo '</pre>';
    }
}

function imprime_bonito_cookies()
{
    if (isset($_COOKIE)) {
        echo '<pre>';
        echo htmlspecialchars(print_r($_COOKIE, true));
        echo '</pre>';
    }
}

function imprime_bonito_post()
{
    if (isset($_POST)) {
        echo '<pre>';
        echo htmlspecialchars(print_r($_POST, true));
        echo '</pre>';
    }
}

function imprime_bonito_files()
{
    if ($_POST) {
        echo '<pre>';
        echo htmlspecialchars(print_r($_FILES, true));
        echo '</pre>';
    }
}

function imprime_bonito_array($arr)
{
    echo '<pre>';
    echo htmlspecialchars(print_r($arr, true));
    echo '</pre>';
}

//Elimina el primer elemento de un array y lo devuelve.
function parse_array_cards($arr_cards)
{
    unset($arr_cards[0]);
    return $arr_cards;
}

//PARSE Cards Data:

function str_word_count_utf8($str)
{
    return count(preg_split('~[^\p{L}\p{N}\']+~u', $str));
}

//devuelve un int con el número de palabras del texto
function count_description_words($text)
{
    return intval(str_word_count($text, 0));
}

//Devuelve un array con las palabras del texto
function arr_description_words($text)
{
    // return str_word_count_utf8($text,1);
    $array_text_words = str_word_count($text, 1);

    return $array_text_words;

}

//Devuelve la descripción acortada o completa según el número de palabras indicadas como máximo.
function short_description($text, $current_num_words, $max_num_words)
{
    if ($current_num_words > $max_num_words) {
        $short_description = "";
        $arr_words = arr_description_words($text);

        for ($i = 0; $i <= $max_num_words; $i++) {
            $short_description .= $arr_words[$i] . " ";
        }
        $short_description .= "(...)";
    } else {
        $short_description = $text;
    }
    return $short_description;
}


function replaced($word)
{
    $word = str_replace("@", "%40", $word);
    $word = str_replace("`", "%60", $word);
    $word = str_replace("¢", "%A2", $word);
    $word = str_replace("£", "%A3", $word);
    $word = str_replace("¥", "%A5", $word);
    $word = str_replace("|", "%A6", $word);
    $word = str_replace("«", "%AB", $word);
    $word = str_replace("¬", "%AC", $word);
    $word = str_replace("¯", "%AD", $word);
    $word = str_replace("º", "%B0", $word);
    $word = str_replace("±", "%B1", $word);
    $word = str_replace("ª", "%B2", $word);
    $word = str_replace("µ", "%B5", $word);
    $word = str_replace("»", "%BB", $word);
    $word = str_replace("¼", "%BC", $word);
    $word = str_replace("½", "%BD", $word);
    $word = str_replace("¿", "%BF", $word);
    $word = str_replace("À", "%C0", $word);
    $word = str_replace("Á", "%C1", $word);
    $word = str_replace("Â", "%C2", $word);
    $word = str_replace("Ã", "%C3", $word);
    $word = str_replace("Ä", "%C4", $word);
    $word = str_replace("Å", "%C5", $word);
    $word = str_replace("Æ", "%C6", $word);
    $word = str_replace("Ç", "%C7", $word);
    $word = str_replace("È", "%C8", $word);
    $word = str_replace("É", "%C9", $word);
    $word = str_replace("Ê", "%CA", $word);
    $word = str_replace("Ë", "%CB", $word);
    $word = str_replace("Ì", "%CC", $word);
    $word = str_replace("Í", "%CD", $word);
    $word = str_replace("Î", "%CE", $word);
    $word = str_replace("Ï", "%CF", $word);
    $word = str_replace("Ð", "%D0", $word);
    $word = str_replace("Ñ", "%D1", $word);
    $word = str_replace("Ò", "%D2", $word);
    $word = str_replace("Ó", "%D3", $word);
    $word = str_replace("Ô", "%D4", $word);
    $word = str_replace("Õ", "%D5", $word);
    $word = str_replace("Ö", "%D6", $word);
    $word = str_replace("Ø", "%D8", $word);
    $word = str_replace("Ù", "%D9", $word);
    $word = str_replace("Ú", "%DA", $word);
    $word = str_replace("Û", "%DB", $word);
    $word = str_replace("Ü", "%DC", $word);
    $word = str_replace("Ý", "%DD", $word);
    $word = str_replace("Þ", "%DE", $word);
    $word = str_replace("ß", "%DF", $word);
    $word = str_replace("à", "%E0", $word);
    $word = str_replace("á", "%E1", $word);
    $word = str_replace("â", "%E2", $word);
    $word = str_replace("ã", "%E3", $word);
    $word = str_replace("ä", "%E4", $word);
    $word = str_replace("å", "%E5", $word);
    $word = str_replace("æ", "%E6", $word);
    $word = str_replace("ç", "%E7", $word);
    $word = str_replace("è", "%E8", $word);
    $word = str_replace("é", "%E9", $word);
    $word = str_replace("ê", "%EA", $word);
    $word = str_replace("ë", "%EB", $word);
    $word = str_replace("ì", "%EC", $word);
    $word = str_replace("í", "%ED", $word);
    $word = str_replace("î", "%EE", $word);
    $word = str_replace("ï", "%EF", $word);
    $word = str_replace("ð", "%F0", $word);
    $word = str_replace("ñ", "%F1", $word);
    $word = str_replace("ò", "%F2", $word);
    $word = str_replace("ó", "%F3", $word);
    $word = str_replace("ô", "%F4", $word);
    $word = str_replace("õ", "%F5", $word);
    $word = str_replace("ö", "%F6", $word);
    $word = str_replace("÷", "%F7", $word);
    $word = str_replace("ø", "%F8", $word);
    $word = str_replace("ù", "%F9", $word);
    $word = str_replace("ú", "%FA", $word);
    $word = str_replace("û", "%FB", $word);
    $word = str_replace("ü", "%FC", $word);
    $word = str_replace("ý", "%FD", $word);
    $word = str_replace("þ", "%FE", $word);
    $word = str_replace("ÿ", "%FF", $word);
    return $word;
}

function parse_to_utf($word)
{
    $correct = urldecode(replaced($word));
    return $correct;
}

?>
