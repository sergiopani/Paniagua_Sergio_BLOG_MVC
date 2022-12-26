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

        // $valorsPossibles = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        // for ($i = 1; $i <= 6; $i++) {
        //     $resultat .= $valorsPossibles[rand(0, strlen($valorsPossibles) - 1)];
        // }

        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_body.php";
        include "templates/tpl_footer.php";
    }
}
