<?php
require "functions.php";



session_start();
$arr_data =  unserialize($_SESSION['data']);


?>
<!DOCTYPE HTML>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport">
    <!-- Bootstrap CSS -->
    <title>Trello Report</title>
    <style type="text/css">
    .logo{
      width:15%;
      height:15%;
    }
    .cardId{
      color:grey;
    }
    h2{
      color:darkred;
    }
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;
      overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;
      font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg .tg-baqh{text-align:center;vertical-align:top}
    .tg .tg-0lax{text-align:left;vertical-align:top}
    .fechas{
       display: table-cell;
       vertical-align:middle;
    }
    .pill{
      background-color: lightgrey;
      border: none;
      color: black;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      margin: 4px 2px;
      border-radius: 16px;
    }

    </style>
  </head>
  <body>
    <div id="cabecera">
      <img class="logo" src="img/bcnlogo.png" />
      <h1>Trello Report</h1>
    </div>
    <div class="card">
      <?php


      $html = "";
      foreach($arr_data as $i => $card){

        //parse description
      $num_words = count_description_words($card['descripcion']);
      $parsed_description = short_description($card['descripcion'],$num_words,20);

      $full_description = $card['descripcion'];


$html .="<fieldset>";
$html .= '<table class="tg">';
$html .= '<thead>';
$html .=  '<tr>';
//id
$html .=   "<th class='tg-0lax'><span class='cardId'>".$i."</span></th>";
//link
$html .=   "<th class='tg-baqh'><a target='_blank' href='".$card['url']."'  /> Link a la tarjeta </th>";
$html .=  '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
$html .= ' <tr>';
//nombre
$html .=    "<td class='tg-0lax'><h2>".$card['name']."</h2></td>";
//fechas
$html .=   " <td class='tg-0lax fechas'>".$card['fcreacion']." - ".$card['ffinalizacion']."</td>";


$html .=  '</tr>';
$html .= ' <tr>';
//Etiquetas:
if (sizeof($card['etiquetas']) >= 1) {
  $listado_etiquetas = "";
  foreach ($card['etiquetas'] as $etiqueta) {
      $estilo = "style ='color:". $etiqueta['color'] .";'";
      $listado_etiquetas .= "<span class='pill' ".$estilo.">".$etiqueta['name']. " </span>";
  }
  $texto = "Etiquetas: $listado_etiquetas";
  $html .=   "<td class='tg-0lax'>".$texto."</td>";
}else{
  $html .=   "<td class='tg-0lax'></td>";
}
//num comentarios
$html .=   "<td class='tg-0lax'>Nº de Comentarios:".$card['comentarios']."</td>";
$html .=  '</tr>';
$html .= ' <tr>';
//descripcion
$html .=    "<td class='tg-0lax'><h3>".  $full_description."</h3></td>";
$html .=   ' <td class="tg-0lax"></td>';
$html .=  '</tr>';
$html .= ' <tr>';
$html .=    '<td class="tg-0lax"></td>';
$html .=    '<td class="tg-0lax"></td>';
$html .=  '</tr>';
$html .= '</tbody>';
$html .= '</table>';

$html .="</fieldset>";
      }
      echo $html;
      ?>

    </div>



  </body>

</html>
