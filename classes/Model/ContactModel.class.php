<?php

class ContactModel
{

    public function __construct()
    {
    }

    public static function create($contact)
    {
        $xml = simplexml_load_file('XmlData/contacts.xml');

        $contacto = $xml->addChild('contacto');
        $contacto->addChild('username', $contact->getUsername());
        $contacto->addChild('email', $contact->getEmail());
        $contacto->addChild('password', $contact->getPassword());
        $contacto->addChild('genero', $contact->getGenero());
        $contacto->addChild('descripcion', $contact->getDescripcion());

        $xml->asXML('XmlData/contacts.xml');

        return true;
    }
}
