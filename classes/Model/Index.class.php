<?php
class Index
{
    /**
     * Pongo las propiedades publicas,
     * para que asi se puede acceder sin
     * necesidad de hacer getters y setters
     */

    public $indice; //Primary key en la tabla
    public $descripcio;

    public $accions; //Lista de acciones relacionadas con este index

    public function __construct()
    {
        /**
         * Vaciado, ya que despues es cuando 
         * los añadire dinamicamente
         */
    }
}
