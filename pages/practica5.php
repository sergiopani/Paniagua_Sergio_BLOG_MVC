<?php


include 'header.php';
/**INICIAMOS LA SESION */
session_start();

/****** PASO 1 HACEMOS WEB SCRAPPING A LA PAGINA******/
$html_content = file_get_contents("https://www.inversis.com/inversiones/productos/cotizaciones-nacionales&pathMenu=3_1_0_0&esLH=N");

/****** PASO 2 GANERAMOS UNA ARRAY ASOCIATIVO****************/
$finalArray = generate_array($html_content);

/****** PASO 3 ECHO DEL ARRAY EN UNA TABLA HTML */
echo create_html_table($finalArray);

/******* PASO 4 GUARDAR EN SESION EL VALOR ANTERIOR A   */
guardar_en_la_sesion($finalArray);

/******* PASO 5 la funcion comprobacion de valor nos compara el ultimo valor */
/*******ESTE PASO LO REALIZO EN LA FUNCION DE CREATE_HTML_TABLE */

/**
 * Objetivo: Apartir de webscraping de una file_get_cointent,
 * generar un array asociativo
 *
 * Contras: Funcion bastante larga
 *  
 * @param string contenido hecho con file_get_contents
 * @return array array con los datos de la tabla
 *
 */
function generate_array($html_content)
{
    $loopCounter = 0;
    $final = 0;
    $array = array();
    while ("tr_" . $loopCounter != "tr_35") {
        $actualTr = "tr_" . $loopCounter;
        $posicionActual = strpos($html_content, $actualTr);
        $html_content = substr($html_content, $posicionActual);
        /*** LAS  PRIMERAS COLUMNAS*********/
        /****** NOMRBE **********/
        $initial = strpos($html_content, 'value="N"') + 12;
        $final = strpos($html_content, '</td>', $initial);
        $nombre = substr($html_content, $initial, $final - $initial);
        /******** TICKER ********/
        $initial = strpos($html_content, '<td>', $final) + 4;
        $final = strpos($html_content, '</td>', $initial);
        $ticker = substr($html_content, $initial, $final - $initial);
        /********* MERCAT *******/
        $initial = strpos($html_content, '<td>', $final) + 4;
        $final = strpos($html_content, '</td>', $initial);
        $mercado = substr($html_content, $initial, $final - $initial);
        /******* PRECIO ULTIMA COTITACION*********/
        $initial = strpos($html_content, 'field="precio_ultima_cotizacion"') + 33;
        $final = strpos($html_content, '</span>', $initial);
        $precio_ultima_cotizacion = substr($html_content, $initial, $final - $initial);

        /************ DIVISA******************/
        $initial = $final + 37;
        $final = strpos($html_content, '</td>', $initial);
        $divisa = substr($html_content, $initial, $final - $initial);

        /****** VARIACION PUNTOS ***************/
        $initial = strpos($html_content, 'id="tdDif_' . $loopCounter) + 14;
        $final = strpos($html_content, '</span>', $initial);
        $variacion_puntos = substr($html_content, $initial, $final - $initial);

        /********VARIACION PORCENTUAL **********/
        $initial = strpos($html_content, 'id="tdPorcDif_' . $loopCounter) + 18;
        $final = strpos($html_content, '</span>', $initial);
        $variacion_porcentual = substr($html_content, $initial, $final - $initial);

        /********VOLUMEN **********/
        $initial = strpos($html_content, 'field="volumen"') + 16;
        $final = strpos($html_content, '</span>', $initial);
        $volumen = substr($html_content, $initial, $final - $initial);

        /******* MINIMO ********/
        $initial = strpos($html_content, 'field="minimo"') + 15;
        $final = strpos($html_content, '</span>', $initial);
        $minimo = substr($html_content, $initial, $final - $initial);

        /****** MAXIMO *****/
        $initial = strpos($html_content, 'field="maximo"') + 15;
        $final = strpos($html_content, '</span>', $initial);
        $maximo = substr($html_content, $initial, $final - $initial);

        /***** FECHA HORA COTIZACION *******/
        $initial = strpos($html_content, 'field="fecha_hora_cotizacion"') + 30;
        $final = strpos($html_content, '</span>', $initial);
        $fecha_hora_cotizacion = substr($html_content, $initial, $final - $initial);

        /********** HORA ULTIMA COTIZACION *********/
        $initial = strpos($html_content, 'field="hora_ultima_cotizacion_instituc"') + 40;
        $final = strpos($html_content, '</span>', $initial);
        $hora_ultima_cotizacion = substr($html_content, $initial, $final - $initial);

        /********** RELLENAR ARRAY ASOCIATIVO *********/
        $array[$loopCounter] =  array(
            /****En el nombre utilizamos trim porque solo queremos quitar los espacios de los lados */
            "nom" =>  preg_replace('/\s+/', '', $nombre),
            "ticker" => preg_replace('/\s+/', '', $ticker),
            "mercat" => preg_replace('/\s+/', '', $mercado),
            "precio_ultima_cotizacion" => preg_replace('/\s+/', '', $precio_ultima_cotizacion),
            "divisa" => preg_replace('/\s+/', '', $divisa),
            "variacion_puntos" => preg_replace('/\s+/', '', $variacion_puntos),
            "variacion_porcentual" => preg_replace('/\s+/', '', $variacion_porcentual),
            "volumen" => preg_replace('/\s+/', '', $volumen),
            "minimo" => preg_replace('/\s+/', '', $minimo),
            "maximo" => preg_replace('/\s+/', '', $maximo),
            "fecha_hora_cotizacion" => preg_replace('/\s+/', '', $fecha_hora_cotizacion),
            "hora_ultima_cotizacion" => preg_replace('/\s+/', '', $hora_ultima_cotizacion),
        );

        // $html_content = substr($html_content, $actualTr);

        $loopCounter++;
    }

    return $array;
}

function guardar_en_la_sesion($array)
{
    /* RECORRRMOS LA ARRAY Y MIRAMOS SI EL VALOR ANTERIOR ES DIFERENTE AL NUEVO */
    foreach ($array as $key => $value) {
        $_SESSION["valor" . $key] = $value["precio_ultima_cotizacion"];
    }
}
/**
 * 
 * MAYOR: return 1
 * MENOR: return -1
 * IGUAL: return 0 
 */
function comprobacion_del_valor($key, $valor)
{

    if (isset($_SESSION["valor" . $key])) {
        if ($_SESSION["valor" . $key] > $valor) {
            return -1;
        } else if ($_SESSION["valor" . $key] < $valor) {
            return 1;
        } else {
            return 0;
        }
    }
}

/**
 * Objetivo: Obtener el contenido de una tabla HTML a partir de una array
 * @params Array desde la que vamos a crear el html table
 * @return String con el html table  *
 */
function create_html_table($array)
{
    $html_result = "
    <button id='recargar' onclick='window.location.reload();'>Recarga las cotizaciones!</button>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Ticker</th>
                <th>Mercado</th>
                <th>Precio Ultima Cotizacion</th>
                <th>Divisa</th>
                <th>Variacion Puntos</th>
                <th>Variacion Porcentual</th>
                <th>Volumen</th>
                <th>Minimo</th>
                <th>Maximo</th>
                <th>Fecha Hora Cotizacion</th>
                <th>Hora Ultima Cotizacion</th>
            </tr>
         </thead>
    
    ";
    $html_result .= "<tbody>";

    foreach ($array as $key => $value) {
        $html_result .= "
        <tr>
            <td>" . $value['nom'] . "</td>
            <td>" . $value['ticker'] . "</td>
            <td>" . $value['mercat'] . "</td>
            ";
        if (comprobacion_del_valor($key, $value['precio_ultima_cotizacion']) == 1) {
            $html_result .= "<td class='good-result''>" . $value['precio_ultima_cotizacion'] . "</td>";
        } else if (comprobacion_del_valor($key, $value['precio_ultima_cotizacion']) == -1) {
            $html_result .= "<td class='bad-result'>" . $value['precio_ultima_cotizacion'] . "</td>";
        } else {
            $html_result .= "<td >" . $value['precio_ultima_cotizacion'] . "</td>";
        }


        $html_result .= "            
            <td>" . $value['divisa'] . "</td>";

        if ($value['variacion_puntos'] > 0) {
            $html_result .= "<td class='good-result'>" . $value['variacion_puntos'] . "</td>";
            $html_result .= "<td class='good-result'>" . $value['variacion_porcentual'] . "</td>";
        } else {
            $html_result .= "<td class='bad-result'>" . $value['variacion_puntos'] . "</td>";
            $html_result .= "<td class='bad-result'>" . $value['variacion_porcentual'] . "</td>";
        }

        $html_result .= "<td>" . $value['volumen'] . "</td>
            <td>" . $value['minimo'] . "</td>
            <td>" . $value['maximo'] . "</td>
            <td>" . $value['fecha_hora_cotizacion'] . "</td>
            <td>" . $value['hora_ultima_cotizacion'] . "</td>
        </tr>
        ";
    }
    $html_result .= "</tbody></table>";
    return $html_result;
}



?>




<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 4</title>
    <!-- <link rel="stylesheet" href="/styles/" /> -->
    <style>
        body {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 0 auto;
            margin-top: 20px;

        }

        th {
            background-color: #31C6D4;
            color: white;
        }

        tr {
            border: 1px solid black;
            text-align: center;
            height: 30px;
        }

        .bad-result {
            background-color: #FF1E1E;
        }

        .good-result {
            background-color: #00FFD1;
        }

        .same-result {
            background-color: yellow;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #recargar {
            margin-top: 120px;
            height: 30px;
        }
    </style>
</head>

<body>


</body>

</html>