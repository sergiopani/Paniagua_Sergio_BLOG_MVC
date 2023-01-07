<?php

class User
{

    private $username;
    private $email;
    private $password;
    private $genero;
    private $direccion;
    private $codigo_postal;
    private $poblacion;
    private $provincia;
    private $telefono;

    private $imagen;

    public function __construct(
        $username,
        $email,
        $password,
        $genero,
        $direccion,
        $codigo_postal,
        $poblacion,
        $provincia,
        $telefono,
        $imagen
    ) {

        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->genero = $genero;
        $this->direccion = $direccion;
        $this->codigo_postal = $codigo_postal;
        $this->poblacion = $poblacion;
        $this->provincia = $provincia;
        $this->telefono = $telefono;
        $this->imagen = $imagen;
    }


    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getCodigoPostal()
    {
        return $this->codigo_postal;
    }

    public function getPoblacion()
    {
        return $this->poblacion;
    }

    public function getProvincia()
    {
        return $this->provincia;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getImagen()
    {
        return $this->imagen;
    }
}
