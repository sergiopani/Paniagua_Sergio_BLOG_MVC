<?php

class BlogUser
{
    private $id;
    private $email;
    private $password;
    private $tipusIdent;
    private $numeroIdent;
    private $nom;
    private $cognoms;
    private $sexe;
    private $naixement;
    private $adreca;
    private $codiPostal;
    private $poblacio;
    private $provincia;
    private $telefon;
    private $imatge;
    private $status;
    private $navegador;
    private $plataforma;
    private $dataCreacio;
    private $dataDarrerAcces;


    public function __construct($email, $password, $status)
    {
        /**
         * Los unicos que he decidido que sean obligatorios
         * al innstanciar un BlogUser
         * los demas los añadire segun vea
         */

        $this->email = $email;
        $this->password = $password;
        $this->status = $status;
    }

    //getters
    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getTipusIdent()
    {
        return $this->tipusIdent;
    }

    public function getNumeroIdent()
    {
        return $this->numeroIdent;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getCognoms()
    {
        return $this->cognoms;
    }

    public function getSexe()
    {
        return $this->sexe;
    }

    public function getNaixement()
    {
        return $this->naixement;
    }

    public function getAdreca()
    {
        return $this->adreca;
    }

    public function getCodiPostal()
    {
        return $this->codiPostal;
    }

    public function getPoblacio()
    {
        return $this->poblacio;
    }

    public function getProvincia()
    {
        return $this->provincia;
    }

    public function getTelefon()
    {
        return $this->telefon;
    }

    public function getImatge()
    {
        return $this->imatge;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getNavegador()
    {
        return $this->navegador;
    }

    public function getPlataforma()
    {
        return $this->plataforma;
    }

    public function getDataCreacio()
    {
        return $this->dataCreacio;
    }

    public function getDataDarrerAcces()
    {
        return $this->dataDarrerAcces;
    }


    //setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setTipusIdent($tipusIdent)
    {
        $this->tipusIdent = $tipusIdent;
    }

    public function setNumeroIdent($numeroIdent)
    {
        $this->numeroIdent = $numeroIdent;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setCognoms($cognoms)
    {
        $this->cognoms = $cognoms;
    }

    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    public function setNaixement($naixement)
    {
        $this->naixement = $naixement;
    }

    public function setAdreca($adreca)
    {
        $this->adreca = $adreca;
    }

    public function setCodiPostal($codiPostal)
    {
        $this->codiPostal = $codiPostal;
    }

    public function setPoblacio($poblacio)
    {
        $this->poblacio = $poblacio;
    }

    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    }

    public function setTelefon($telefon)
    {
        $this->telefon = $telefon;
    }

    public function setImatge($imatge)
    {
        $this->imatge = $imatge;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setNavegador($navegador)
    {
        $this->navegador = $navegador;
    }

    public function setPlataforma($plataforma)
    {
        $this->plataforma = $plataforma;
    }

    public function setDataCreacio($dataCreacio)
    {
        $this->dataCreacio = $dataCreacio;
    }

    public function setDataDarrerAcces($dataDarrerAcces)
    {
        $this->dataDarrerAcces = $dataDarrerAcces;
    }
}
