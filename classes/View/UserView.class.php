<?php
class UserView extends View
{

    public function __construct()
    {
        parent::__construct();
    }

    public function registre($message = null, $message_type = null)
    {
        /**
         * Incluimos el fichero de traduciones
         */
        include_once $this->getFitxer();


        /**
         * Includimos las templates
         */
        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_register.php";
        include "templates/tpl_footer.php";
    }
}
