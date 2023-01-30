<?php

class SectorModel extends Model
{
    private const TABLA = 'tbl_sectors';

    
    public function __construct()
    {
        $this->conect = $this->getInstance()->conect;
    }

    public function create(Sector $sector)
    {
        try {
            $sentence = "INSERT INTO " . self::TABLA . " (sector) VALUES (:sector)";

            $query = $this->conect->prepare($sentence);

            $query->execute(
                array(
                    ':sector' => $sector->sector
                )
            );

            /**
             * Devuelve el numero de filas afectadas
             * Asi podemos comprobar si se ha insertado correctamente
             */
            return $query->rowCount();

        }catch(PDOException $e) {
            throw new Exception("No se ha podido crear el sector" . $e->getMessage());
        }
    }

    public function read($limit, $offset)
    {

        try {
            /**
             * Leo un numero limitado de acciones
             * Limitado por los dos parametros
             * El objetivo es devolver una array de acciones
             */
            $sentence = "SELECT * FROM " . self::TABLA . " LIMIT :limit OFFSET :offset";
            $query = $this->conect->prepare($sentence);
            $query->execute(
                array(
                    ':limit' => $limit,
                    ':offset' => $offset
                )
            );
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            $toReturn = array();
            foreach($result as $sector){
                /**
                 * Un objeto sector tiene dos propiedades
                 * -> Nombre del sector
                 * -> Array de acciones de ese sector
                 */
                $aux = new Sector();
                $aux->sector = $sector['sector'];
                $aux->accions = $this->getAllBySector($sector['sector']);

                array_push($toReturn, $aux);
            }

            return $toReturn;
        } catch (PDOException $e) {
            throw new Exception("No se ha podido leer el sector" . $e->getMessage());
        }

        //tiene que ser bidireccionales, por lo que en accion
        /**
         * N a N bidireccional, tenemos una array en un objeto 
         * y una referencia en el otro
         */

        /**
         * GetAllBySector -> que devuelve una array con objetos de acciones
         * getAllBySector($registre)
         */


        /**
         * No hacer inner joins
         * En la base de datos las referencias las hacen las claves, entonces
         * no podemos 
         * En la tabla no tenemos el objeto, solo tenemos la id, 
         */

        /**
         * Por ejemplo el numero de acciones que tenemos de Accerinox
         *Accerinox es un objeto que tendra la array de acciones
         *Numero de acciones, es cuantas acciones hay en ese sector
         */

        
    }

    public function getMercatById($id)
    {
        try {

            $sentence = "SELECT * FROM " . self::TABLA . " WHERE id = :id";
            $query = $this->conect->prepare($sentence);
            $query->execute(
                array(
                    ':id' => $id
                )
            );
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            throw new Exception("No se ha podido leer el sector" . $e->getMessage());
        }
    }

    public function getAllBySector($sectorId) {
        $sentence = "SELECT * FROM tbl_accions WHERE sector_id = :sectorId";
        $query = $this->conect->prepare($sentence);
        $query->execute(
            array(
                ':sectorId' => $sectorId
            )
        );
    
        $result = $query->fetchAll();
        $accions = array();
        foreach ($result as $accion) {
            $a = new Accio();
            
            $a->nom = ($accion['nom']);
            $a->ticker = ($accion['ticker']);
            $a->mercat_id = ($accion['mercat_id']);
            $a->imatge = ($accion['imatge']);
            $a->isIn = ($accion['isin']);
            $a->sectorId = ($accion['sector_id']);

            
            array_push($accions, $a);
        }
        return $accions;
    }
}