<?php

class FrontController extends Controller
{
    public function __construct()
    {
        //Vaciado
    }


    public function dispatch()
    {
        $params = null;
        /**
         * PASO 1 -> Comprobar si nos llega algo por get
         * Si get esta vacio quiere decir que nos tenemos que dirigir a la Home Page
         * Ya que no nos llega ningun parametro por la url
         */
        if ($_SERVER["REQUEST_METHOD"] == "GET" && count($_GET) == 0) {
            /**
             * PASO 2 -> Como no nos ha llegado ningun parametro por la url
             * Nos dirigimos al homeController
             * y a su metodo de show
             */
            $controller_name = "HomeController";
            $action = "show";
        } else {
            /**
             * PASO 3 -> Tratar con los parametros de la url
             */
            $url = array_keys($_GET)[0];
            $url = $this->sanitize($url, 0);
            $url = trim($url, "/");
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            /**
             * PASO 4 -> Si existe la key[0], quiere decir que el controler es valido
             * por lo tanto nos movemos hacia el controler
             */
            if (isset($url[0])) {
                $controller_name = ucwords($url[0]) . "Controller";
                if (isset($url[1])) {
                    /**
                     * PASO 5 -> Obtenemos el metodo del controler
                     */
                    $action = $url[1];
                }
                /**
                 * PASO 6 -> Si hay mas de 2 parametros ya tenemos parametros
                 * nos los guardamos en una array
                 */
                if (count($url) > 2) {
                    for ($i = 2; $i < count($url); $i++) {
                        $params[] = strtolower($url[$i]);
                    }
                }
            }
        }
        /**
         * PASO 7 -> Creamos una nueva instacia del controller con el dato que hemos 
         * obtenido del url[0] y llamamos al metodo de este controller
         * que hemos obtenido en el url[1] pasandole como parametro
         * los parametros que hemos guardado en $params
         */
        if (file_exists("classes/Controller/$controller_name.class.php")) {
            $controller = new $controller_name();
            if (method_exists($controller, $action)) {
                $controller->$action($params);
            } else {
                throw new Exception("No existeix l'acció demanada: $action");
            }
        } else {
            throw new Exception("No existeix el controlador demanat: $controller_name");
        }
    }
}
