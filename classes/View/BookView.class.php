<?php
class BookView extends View
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show($contactosArray = array(), $errores = array())
    {
        require_once $this->getFitxer();

        $comentarios_html = $this->htmlGenerateContactos($contactosArray);

        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_guess_book.php";
        include "templates/tpl_footer.php";
    }
}
