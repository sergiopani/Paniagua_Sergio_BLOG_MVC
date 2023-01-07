<?php
class HomeView extends View
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show()
    {
        /**
         * PASO 1 -> Requerimos el fichero con la array de traduciones
         */

        require_once $this->getFitxer();


        /** 
         * PASO 2 -> Preparamos la alerta para el html
         * Este tipo de alertas es para mostrar mensajes
         * como el de logout, o el de registro correcto
         */
        $alert = '';
        if (isset($_POST['message']) && isset($_POST['message_type'])) {
            $alert = $this->getAlert($_POST['message'], $_POST['message_type']);
        }

        /**
         * PASO 3 -> Preparamos el usuario por si lo tenemos que usar
         */
        if (isset($_SESSION['email'])) {
            $user_email = $_SESSION['email'];
        }


        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_body.php";
        include "templates/tpl_footer.php";
    }
}
