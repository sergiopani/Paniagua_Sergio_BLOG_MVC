<?php
class Contacto
{
    private $mensaje;
    private $experiencia;
    private $nombre;
    private $mail;
    private $fecha;

    public function __construct($nom, $email, $comentari, $data = null, $experiencia = null)
    {
        $this->nombre = $nom;
        $this->mail = $email;
        $this->mensaje = $comentari;
        $this->fecha = ($data == null) ? date("Y-m-d") : $data;
        //Experiencia mala por defecto
        $this->experiencia = ($experiencia == null) ? 'Mala' : $experiencia;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->mail;
    }

    /**
     * @return mixed
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * @return mixed
     */
    public function getExperiencia()
    {
        return $this->experiencia;
    }
}
