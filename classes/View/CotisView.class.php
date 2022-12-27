<?php
class CotisView extends View
{
    public function __construct()
    {
        //Seteamos el atributo de lang
        //Al que tenemos puesto en las cookies
        parent::__construct();
    }

    public function show($array)
    {
        require_once $this->getFitxer();

        $table = $this->create_html_table($array);
        /**
         * Incluimos todas las templates que se van a mostrar
         */
        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_cotis.php";
        include "templates/tpl_footer.php";
    }

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
            if ($this->comprobacion_del_valor($key, $value['precio_ultima_cotizacion']) == 1) {
                $html_result .= "<td class='good-result''>" . $value['precio_ultima_cotizacion'] . "</td>";
            } else if ($this->comprobacion_del_valor($key, $value['precio_ultima_cotizacion']) == -1) {
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
}
