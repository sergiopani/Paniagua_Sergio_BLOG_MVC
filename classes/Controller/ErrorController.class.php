<?php

class ErrorController extends Controller
{

    public function __construct()
    {
    }

    public function error()
    {
        /**
         * PASO 1 -> Instanciamos la clase HomwView y llamamos a su metodo show()
         */
        $vista = new ErrorView();


        $vista->show();
    }

    public function ok()
    {
        $vista = new ErrorView();
        $vista->show();
    }
}
