<?php

class MercatModel extends Model
{

    private const TABLA = 'tbl_mercats';

    public function __construct()
    {
        $this->conect = $this->getInstance()->conect;
    }


    public function create(Mercat $mercat)
    {
        if (empty($mercat)) {
            throw new Exception("Mercat para crear incorrecto!");
        }

        try {
            $sentence = "INSERT INTO " . self::TABLA . " (mercat, pais, moneda) VALUES (:mercat, :pais, :moneda)";

            $query = $this->conect->prepare($sentence);

            $query->execute(
                array(
                    ':mercat' => $mercat->mercat,
                    ':pais' => $mercat->pais,
                    ':moneda' => $mercat->moneda
                )
            );

            /**
             * Devuelve el numero de filas afectadas
             * Asi podemos comprobar si se ha insertado correctamente
             */
            return $query->rowCount();

        } catch (PDOException $e) {
            throw new Exception("No se ha podido crear el mercat" . $e->getMessage());
        }

    }

    public function update(Mercat $mercat)
    {
        if (empty($mercat)) {
            throw new Exception("Mercat para actualizar incorrecto!");
        }

        try {
            $sentence = "UPDATE " . self::TABLA . " SET             
            pais = :pais, 
            moneda = :moneda 
            WHERE mercar = :mercat";

            $query = $this->conect->prepare($sentence);

            $query->execute(
                array(
                    ':mercat' => $mercat->mercat,
                    ':pais' => $mercat->pais,
                    ':moneda' => $mercat->moneda
                )
            );

            /**
             * Devuelve el numero de filas afectadas
             * Asi podemos comprobar si se ha insertado correctamente
             */
            return $query->rowCount();

        } catch (PDOException $e) {
            throw new Exception("No se ha podido actualizar el mercat" . $e->getMessage());
        }

    }

    public function delete(Mercat $mercat)
    {
        if (empty($mercat)) {
            throw new Exception("Mercat para eliminar incorrecto!");
        }

        try {
            $sentence = "DELETE FROM " . self::TABLA . " WHERE mercat = :mercat";

            $query = $this->conect->prepare($sentence);

            $query->execute(
                array(
                    ':mercat' => $mercat->mercat
                )
            );

            /**
             * Devuelve el numero de filas afectadas
             * Asi podemos comprobar si se ha insertado correctamente
             */
            return $query->rowCount();

        } catch (PDOException $e) {
            throw new Exception("No se ha podido eliminar el mercat" . $e->getMessage());
        }

    }

    public function read()
    {
        try {
            /**
             * PASO 1 -> La sentencia en string
             */
            $sentence = "SELECT * FROM " . self::TABLA . "";
            /**
             * PASO 2 -> Compila la sentencia
             *  y devuelve un objeto PDOStatement
             */
            $query = $this->conect->prepare($sentence);
            /**
             * PASO 3 -> Ejecutar la sentencia
             */
            $query->execute();
            /**
             * PASO 4 -> Convertir el resultado a una 
             * array de objetos Index, con fetchAll()
             */
            $mercats = $query->fetchAll(PDO::FETCH_CLASS, 'Mercat');
            /**
             * PASO 5 -> Devolver el array de objetos
             */
            return $mercats;

        } catch (PDOException $e) {
            throw new Exception("No se ha podido leer los mercats" . $e->getMessage());
        }

    }


}