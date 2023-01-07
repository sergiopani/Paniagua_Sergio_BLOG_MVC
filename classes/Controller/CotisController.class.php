<?php

class CotisController extends Controller
{
    public function __construct()
    {
        //Vaciado
    }

    public function show()
    {
        /****** PASO 1 HACEMOS WEB SCRAPPING A LA PAGINA */
        $html_content = file_get_contents("https://www.inversis.com/inversiones/productos/cotizaciones-nacionales&pathMenu=3_1_0_0&esLH=N");

        /****** PASO 2 GANERAMOS UNA ARRAY ASOCIATIVO */
        $finalArray = $this->generate_array($html_content);

        /******* PASO 4 GUARDAR EN SESION EL VALOR ANTERIOR A */
        $this->guardar_en_la_sesion($finalArray);

        /****** PASO 5 MOSTRAR EN LA VISTA */
        $vista = new CotisView();
        $vista->show($finalArray);
    }


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
}
