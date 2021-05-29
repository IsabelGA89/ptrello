<?php
require './libs/fpdf/fpdf.php';
require '../functions.php';

class PDF extends FPDF
{
// Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('./img/bcnlogo.png', 10, 8, 33);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30, 10, 'Trello Report', 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);
    }

// Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    //otras funcionalidades:
    //TABLAS:
    //TABLA HORIZONTAL:
    function cabeceraHorizontal($cabecera)
    {
        $this->SetXY(10, 10);
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(2, 157, 116);//Fondo verde de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        foreach ($cabecera as $fila) {
            //Atención!! el parámetro true rellena la celda con el color elegido
            $this->Cell(24, 7, utf8_decode($fila), 1, 0, 'L', true);
        }
    }

    function datosHorizontal($datos)
    {
        $this->SetXY(10, 17);
        $this->SetFont('Arial', '', 10);
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach ($datos as $fila) {
            //El parámetro badera dentro de Cell: true o false
            //true: Llena  la celda con el fondo elegido
            //false: No rellena la celda
            $this->Cell(24, 7, utf8_decode($fila['nombre']), 1, 0, 'L', $bandera);
            $this->Cell(24, 7, utf8_decode($fila['apellido']), 1, 0, 'L', $bandera);
            $this->Cell(24, 7, utf8_decode($fila['matricula']), 1, 0, 'L', $bandera);
            $this->Ln();//Salto de línea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
    }

    function tablaHorizontal($cabeceraHorizontal, $datosHorizontal)
    {
        $this->cabeceraHorizontal($cabeceraHorizontal);
        $this->datosHorizontal($datosHorizontal);
    }
}

//encoding characters: https://stackoverflow.com/questions/3514076/special-characters-in-fpdf-with-php
function em($word){
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
function parse_characters_to_utf($word)
{
    $correct = urldecode(em($word));
    return $correct;
}
function text($text)
{
    return iconv('UTF-8', 'iso-8859-2//TRANSLIT//IGNORE', $text);
}

//Download PDF:
function download_PDF($arr_cards)
{
    $num_elementos = sizeof($arr_cards);

    // Creación del objeto de la clase heredada
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 14);

    foreach ($arr_cards as $i => $card) {
        if ($card[$i] != 0) {
            $pdf->Cell(0, 5, 'Id Tarjeta: ' . $i, 0, 1);
        }
        //Titulo:
        $pdf->Cell(10, 10, print_r(parse_characters_to_utf($card['name']), true), 0, 1);
        //Descripcion:
        if ($card['descripcion'] != null) {
            //Comprobar extensión de la descripción y cortar si es demasiado larga.
            $num_words = count_description_words($card['descripcion']);
            $parsed_description = short_description($card['descripcion'],$num_words,8);
            $pdf->Cell(10, 10, print_r("Descripcion: " . parse_characters_to_utf($parsed_description), true), 0, 1);
        }
        if ($card['comentarios'] != null) {
            //Comentarios
            $pdf->Cell(10, 10, "N Comentarios: " . print_r($card['comentarios'], true), 0, 1);
        }
        //url
        $pdf->Cell(10, 10, print_r($card['url'], true), 0, 1);
        //fecha finalización:
        if ($card['ffinalizacion'] != null) {
            $pdf->Cell(10, 10, print_r("Fecha Inicio: " . $card['fcreacion'] . "   -  Fecha Fin: " . $card['ffinalizacion'], true), 0, 1);
        } else {
            if ($card['fcreacion'] != "") {
                //fecha creación:
                $pdf->Cell(10, 10, print_r("Fecha Inicio: " . $card['fcreacion'], true), 0, 1);
            }
        }
        //etiquetas:
        if (sizeof($card['etiquetas']) >= 1) {
            $listado_etiquetas = "";
            foreach ($card['etiquetas'] as $etiqueta) {
                $listado_etiquetas .= parse_characters_to_utf($etiqueta['name']) . " ";
            }
            $texto = "Etiquetas: $listado_etiquetas";
            $pdf->Cell(10, 10, print_r($texto, true), 0, 1);
        }
        $pdf->Cell(10, 10, print_r(" ************************************ ", true), 0, 1);
    }
    $pdf->Output();
}


?>