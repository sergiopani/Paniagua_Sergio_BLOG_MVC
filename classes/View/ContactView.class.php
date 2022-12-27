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


        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        include "templates/tpl_contact.php";
        include "templates/tpl_footer.php";
    }
}
