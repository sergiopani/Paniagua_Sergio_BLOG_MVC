<?php

class UserModel
{

    public function __construct()
    {
    }

    public static function create(User $usuariACrear)
    {

        $xml = simplexml_load_file('XmlData/usuarios.xml');
        $usuario = $xml->addChild('usuario');
        $usuario->addChild('username', $usuariACrear->getUsername());
        $usuario->addChild('email', $usuariACrear->getEmail());
        $usuario->addChild('password', $usuariACrear->getPassword());
        $usuario->addChild('genero', $usuariACrear->getGenero());
        $usuario->addChild('direccion', $usuariACrear->getDireccion());
        $usuario->addChild('codigo_postal', $usuariACrear->getCodigoPostal());
        $usuario->addChild('poblacion', $usuariACrear->getPoblacion());
        $usuario->addChild('provincia', $usuariACrear->getProvincia());
        $usuario->addChild('telefono', $usuariACrear->getTelefono());

        $xml->asXML('XmlData/usuarios.xml');

        return true;
    }

    public static function read()
    {
    }

    public static function getOneById($id)
    {
    }

    public static function getOneByMail($id)
    {
    }

    public static function update(User $usuariAModificar)
    {
    }

    public static function delete(User $usuariAEsborrar)
    {
    }
}
