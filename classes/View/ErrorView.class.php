<?php

class ErrorView extends View
{
    private $exception;

    public function __construct(Exception $ex = null)
    {
        parent::__construct();
        $this->exception = $ex;
    }


    public function show($param = null)
    {
        /**
         * PASO 1-> Fichero con la array de traducciones
         */
        require_once $this->getFitxer();

        /** 
         * PASO 2 -> Preparamos las variables para el template
         */
        $titol = "UNEXPECTED ERROR";
        $missatge = (is_null($this->exception))
            ? ((is_null($param)) ? "Ha ocorregut un error no definit" : $param)
            : $this->exception->getMessage();


        /**
         * PASO 3 -> Incluimos los templates
         */
        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_error.php";
        include "templates/tpl_footer.php";
    }

    public function ok($titol, $missatge)
    {
        require_once $this->getFitxer();
        $lang = $this->lang;
        $html_opacityLang[$lang] = "style=\"opacity:1;\"";

        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_ok.php";
        include "templates/tpl_footer.php";
    }
}
