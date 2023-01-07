<?php

class Contact
{
    private $username;
    private $email;
    private $password;
    private $genero;
    private $descripcion;

    public function __construct($username, $email, $password, $genero, $descripcion)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->genero = $genero;
        $this->descripcion = $descripcion;
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

    public function getDescripcion()
    {
        return $this->descripcion;
    }
}
