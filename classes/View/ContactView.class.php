<?php
class ContactView extends View
{
    private $contact;
    public function __construct($contact)
    {
        parent::__construct();
        $this->contact = $contact;
    }
    public function show($message = null, $message_type = null)
    {
        require_once $this->getFitxer();

        /**
         * PASO 3 -> Preparamos el usuario por si lo tenemos que usar
         */
        if (isset($_SESSION['email'])) {
            $user_email = $_SESSION['email'];
        }

        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_contact.php";
        include "templates/tpl_footer.php";
    }
}
