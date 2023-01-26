<?php
class IndexModel extends Model
{
    private const TABLA = 'tbl_index';

    public function __construct()
    {
        $this->conect = $this->getInstance()->conect;
    }

    public function create(Index $index)
    {
        if (empty($index)) {
            throw new Exception("Index para crear incorrecto!");
        }

        try {
            $sentence = "INSERT INTO " . self::TABLA . " (indice, descripcio) VALUES (:indice, :descripcio)";

            $query = $this->conect->prepare($sentence);

            $query->execute(
                array(
                    ':indice' => $index->indice,
                    ':descripcio' => $index->descripcio
                )
            );

            /**
             * Devuelve el numero de filas afectadas
             * Asi podemos comprobar si se ha insertado correctamente
             */
            return $query->rowCount();


        } catch (PDOException $e) {
            throw new Exception("No se ha podido crear el index" . $e->getMessage());
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
             * Devuelve una array con todos los objetos,
             * Y el FETCH_CLASS, indica que los objetos
             * serán de la clase Index
             */
            $result = $query->fetchAll(PDO::FETCH_CLASS, 'Index');
            /**
             * PASO 5 -> Devolver el resultado
             */
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error al leer los registros 
            de la tabla tbl_index: " . $e->getMessage());
        }
    }


    public function update(Index $index)
    {
        //Los parametros no son correctos
        if (empty($index)) {
            throw new Exception("Los parametros no son correctos!");
        }

        //No podemos hacer un update de un index que no existe
        if ($this->getIndexByid($index->indice) == 0) {
            throw new Exception("No existe el index que se quiere actualizar");
        }


        try {
            $sentence = "UPDATE " . self::TABLA . " SET descripcio = :descripcio WHERE indice = :indice";

            $query = $this->conect->prepare($sentence);

            $query->execute(
                array(
                    ':descripcio' => $index->descripcio,
                    ':indice' => $index->indice
                )
            );
        } catch (PDOException $e) {
            throw new Exception("No se ha podido hacer update del index:" . $e->getMessage());
        }


    }

    public function delete(Index $index)
    {

        //Los parametros no son correctos
        if (empty($index)) {
            throw new Exception("Los parametros no son correctos!");
        }

        //No podemos hacer un update de un index que no existe
        if (!$this->getIndexByid($index->indice)) {
            throw new Exception("No existe el index que se quiere actualizar");
        }


        try {
            if (!isset($selector)) {
                throw new Exception("Es imposible esborrar un sector");
            }

            /**
             * PASO 1 -> La sentencia en string
             */
            $sentence = "DELETE FROM tbl_index WHERE indice = :indice";
            /**
             * PASO 2 -> Compila la sentencia
             *  y devuelve un objeto PDOStatement
             */
            $query = $this->conect->prepare($sentence);
            /**
             * PASO 3 -> Ejecutar la sentencia
             * Pasandole los parametros directamente en el execute
             * El execute por dentro ya hace un bindParam
             */
            $query->execute(
                array(
                    ':indice' => $index->indice
                )
            );

            /**
             * PASO 4 -> Devolver el resultado
             */
            return $query;
        } catch (PDOException $e) {
            throw new Exception("Error al borrar el registro 
            de la tabla tbl_index: " . $e->getMessage());
        }
    }



    public function getIndexByid($id)
    {
        try {
            /**
             * PASO 1 -> La sentencia en string
             */
            $sentence = "SELECT * FROM tbl_index WHERE indice = :indice";
            /**
             * PASO 2 -> Compila la sentencia
             *  y devuelve un objeto PDOStatement
             */
            $query = $this->conect->prepare($sentence);
            /**
             * PASO 3 -> Ejecutar la sentencia
             * Pasandole los parametros directamente en el execute
             * El execute por dentro ya hace un bindParam
             */
            $query->execute(
                array(
                    ':indice' => $id
                )
            );
            /**
             * PASO 4 -> Convertir el resultado a un objeto Index
             */
            $result = $query->fetchObject('Index');
            /**
             * PASO 5 -> Returnamos el objeto de tipo index
             */
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error al leer los registros 
            de la tabla tbl_index: " . $e->getMessage());
        }


    }










}