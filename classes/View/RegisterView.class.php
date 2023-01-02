<?php

class RegisterView extends View
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show($user_form = array(), $errores = array(), $message = null, $message_type = null)
    {
        require_once $this->getFitxer();

        /** 
         * PASO 1 -> Preparamos la alerta para el html
         */
        $alert = $this->getAlert($message, $message_type);

        /** 
         * PASO 2 -> Preparamos la array de errores para el html
         */
        $errores = $this->getErrors($errores);

        /** 
         *  Preparamos los datos del formulario para el html
         */
        $user_form = $this->getValues($user_form);


        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_blogRegister.php";
        include "templates/tpl_footer.php";
    }
}
