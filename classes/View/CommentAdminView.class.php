<?php
class CommentAdminView extends View
{
    public function show($contactosArray = array(), $errores = array())
    {
        /**
         * PASO 1 -> Incluimos el fichero de traduciones
         */
        require_once $this->getFitxer();


        /**
         * PASO 2 -> Preparamos el usuario por si lo tenemos que usar
         */
        if (isset($_SESSION['email'])) {
            $user_email = $_SESSION['email'];
        }
        $comentarios_html = $this->htmlGenerateContactos($contactosArray, 'yes');


        /**
         * PASO 3 -> Mostramos todas las templates
         */
        include "templates/tpl_commentsHead.php";
        include "templates/tpl_header.php";
        include "templates/tpl_commentAdmin.php";
        include "templates/tpl_footer.php";
    }
}
