<?php
class LoginView extends View
{
    public function __construct()
    {
        parent::__construct();
    }
    public function show($errores = array(), $actualValues = array())
    {
        require_once $this->getFitxer();
        $alert = '';
        if (isset($_POST['message']) && isset($_POST['message_type'])) {
            $alert = $this->getAlert($_POST['message'], $_POST['message_type']);
        }

        /**
         * PASO 1 -> Vigilamos con los valores que vienen undefined
         * porque sino tendremos errores en la vista
         */
        if (!isset($actualValues['email'])) $actualValues['email'] = '';
        if (!isset($actualValues['password'])) $actualValues['password'] = '';
        if (!isset($errores['email'])) $errores['email'] = '';
        if (!isset($errores['password'])) $errores['password'] = '';

        /**
         * PASO 3 -> Preparamos el usuario por si lo tenemos que usar
         */
        if (isset($_SESSION['email'])) {
            $user_email = $_SESSION['email'];
        }
        /**
         * PASO 2 -> Incluimos todos los templates
         */
        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_blogLogin.php";
        include "templates/tpl_footer.php";
    }
}
