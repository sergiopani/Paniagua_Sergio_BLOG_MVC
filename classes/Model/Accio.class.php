<?php
class Accio{

    /**
     * Propiedades de una accion
     */

    public $nom;
    public $ticker;
    public $mercat_id;//De la relacion bidirecional
    public $imatge;
    public $isIn;
    public $sectorId;//De la relacion bidirecional

    
    public function __construct(){
        
    }

    
}