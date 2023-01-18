<?php
class IndexModel extends Model{


    // public function __construct(){
    //     parent::__construct();
    // }
    public function readIndex(){
        try {
            /**
             * PASO 1 -> La sentencia en string
             */
            $sentence = "SELECT * FROM tbl_index";
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

    public function deleteIndex(Index $index){
        try {
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
        }catch(PDOException $e){
            throw new Exception("Error al borrar el registro 
            de la tabla tbl_index: " . $e->getMessage());
        }
    }



    






}