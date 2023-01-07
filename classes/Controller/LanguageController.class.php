<?php
class LanguageController extends Controller
{

    public function __construct()
    {
        //Vaciado
    }

    public function set($param)
    {
        $idiomesPermesos = array("es", "en", "al", "fr", "xn");
        if (in_array($param[0], $idiomesPermesos)) {
            setcookie("lang", $param[0], time() + 3600);
            $_COOKIE["lang"] = $param[0];
        }


        HomeController::show();
    }
}
