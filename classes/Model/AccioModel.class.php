<?php

class AccioModel extends Model
{

    /**
     * Metodo para crear una accion
     */
    public function __construct()
    {
        $this->conect = $this->getInstance()->conect;
    }

    public function create(Accio $accio)
    {
        if (empty($accio)) {
            throw new Exception("No se puede crear la accion!");
        }

        try {
            /**
             * PASO 1 -> Sentencia 
             */
            $sentence = "INSERT INTO tbl_accions 
            (nom,ticker,mercat_id,imatge,isin,sector_id) VALUES  
            (:nom, :ticker, :mercat_id, :imatge, :isin: :sector_id)";
            /** 
             * PASO 2 -> Preparar la sentencia
             */
            $query = $this->conect->prepare($sentence);

            /**
             * PASO 3 -> Ejecutar con los parametros con el bind param
             * interno del execute
             */
            $query->execute(
                array(
                    ':nom' => $accio->nom,
                    ':ticker' => $accio->ticker,
                    ':mercat' => $accio->mercat_id,
                    ':imatge' => $accio->imatge,
                    ':isin' => $accio->isIn,
                    ':sector_id' => $accio->sectorId
                )
            );

            /**
             * PASO 4 -> Devolver el resultado
             */
            $result = $query->rowCount();


            /**
             * Me falta actualizar la tabla intermedia, para eso tengo que actualizar 
             * Hago el prepare una sola vez, y solo relaciono, relacion
             * 
             * insert into rel_index_accions(accio_id,index_id)
             * values(:accio, :index);
             * !TODO mirar la captura que hecho en el smartphone
             * 
             * Con accion model tambien tengo que hacer lo mismo
             * 
             * 
             */
            return $result;
        } catch (PDOException $e) {
            throw new PDOException("No se ha podido crear la accion: " . $e->getMessage());
        }
    }

    public function read()
    {
        try {
            $sentence = "SELECT * FROM tbl_accions";

            $query = $this->conect->prepare($sentence);

            $query->execute();

            /**
             * Objeto a medias, tengo que añadir las
             */
            return $query->fetchAll(PDO::FETCH_CLASS, 'Accio');


        } catch (PDOException $e) {
            throw new PDOException("No se han podido leer las acciones: " . $e->getMessage());
        }

    }

    public function update(Accio $accio)
    {
        if ($accio == null) {
            throw new Exception("No se puede actualizar la accion");
        }

        if ($this->getAccioByName($accio->nom) == null) {
            throw new Exception("No se puede actualizar la accion");
        }

        try {
            $sentence = "UPDATE tbl_accions SET 
            nom = :nom, 
            ticker = :ticker, 
            mercat_id = :mercat_id, 
            imatge = :imatge, 
            isin = :isin, 
            sector_id = :sector_id 
            WHERE nom = :nom";

            $query = $this->conect->prepare($sentence);

            $query->execute(
                array(
                    ':nom' => $accio->nom,
                    ':ticker' => $accio->ticker,
                    ':mercat' => $accio->mercat_id,
                    ':imatge' => $accio->imatge,
                    ':isin' => $accio->isIn,
                    ':sector_id' => $accio->sectorId
                )
            );

            $result = $query->rowCount();

            return $result;
        } catch (PDOException $e) {
            throw new PDOException("No se ha podido actualizar la accion: " . $e->getMessage());
        }
    }

    public function delete(Accio $accio)
    {
        if (empty($accio)) {
            throw new Exception("No se puede eliminar la accion");
        }

        if ($this->getAccioByName($accio->nom) == null) {
            throw new Exception("No se puede eliminar la accion");
        }

        try {
            $sentence = "DELETE FROM tbl_accions WHERE nom = :nom";

            $query = $this->conect->prepare($sentence);

            $query->execute(
                array(
                    ':nom' => $accio->nom
                )
            );

            $result = $query->rowCount();

            return $result;
        } catch (PDOException $e) {
            throw new PDOException("No se ha podido eliminar la accion: " . $e->getMessage());
        }

    }

    public function getAccioByName($name)
    {
        try {
            $sentence = "SELECT * FROM tbl_accions WHERE nom = :nom";

            $query = $this->conect->prepare($sentence);

            $query->execute(
                array(
                    ':nom' => $name
                )
            );

            return $query->fetchAll(PDO::FETCH_CLASS, 'Accio');
        } catch (PDOException $e) {
            throw new PDOException("No se ha podido leer la accion: " . $e->getMessage());
        }
    }





}