<?php

class HomeController extends Controller
{

    public function __construct()
    {
        //Vaciado
    }

    public static function show()
    {
        /**
         * PASO 1 -> Instanciamos la clase HomwView y llamamos a su metodo show()
         */
        $vista = new HomeView();



        $vista->show();
    }
}
