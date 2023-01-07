<?php
class ComentarioModel
{
    const RUTA = 'XmlData/GuessBook.xml';

    public static function create(Comentario $contacto)
    {
        /**
         * PASO 0 -> Leemos el xml actual que nos devutlve un array
         */
        $contactosArray = self::read();

        /**
         * PASO 1 -> CREAMOS EL NODO RAIZ
         * MENSAJE
         * EXPERIENCIA
         * NOMBRE
         * CORREO 
         */

        $root = new SimpleXMLElement('<mensajes></mensajes>');

        /**
         * PASO 2 -> CREAMOS EL NODO CONTACTO -> Suponemos que el nodo padre de mensajes se encuentra creado
         */

        /**
         * PASO 2.2 -> Añadimos el contacto nuevo a la array 
         */
        $contactosArray[] = $contacto;
        foreach ($contactosArray as $contacto) {
            /**
             * PASO 4 -> CREAMOS LOS NODOS HIJOS DE CONTACTO
             */
            $nodoContacto = $root->addChild('contacto');
            $nodoContacto->addChild('mensaje', $contacto->getMensaje());
            $nodoContacto->addChild('experiencia', $contacto->getExperiencia());
            $nodoContacto->addChild('nombre', $contacto->getNombre());
            $nodoContacto->addChild('correo', $contacto->getEmail());
            $nodoContacto->addChild('correo', $contacto->getFecha());
        }
        /**
         * PASO 4 -> GUARDAMOS EL FICHERO
         */
        try {
            $root->asXML(self::RUTA);
        } catch (Exception $e) {
            throw new Exception("No tienes permisos para escribir en el xml!");
        }
    }

    public static function read()
    {
        /**
         * PASO 1 -> Comprobamos si existe el fichero
         */

        if (file_exists(self::RUTA)) {
            /**
             * PASO 2 -> Cargamos el fichero xml
             */
            $fichero = simplexml_load_file(self::RUTA);

            /**
             * PASO 3 -> Recorremos el fichero xml
             * guardamos los datos en un array
             */
            // $nom, $email, $comentari, $data = null, $experiencia = null
            $contactos = array();
            foreach ($fichero->children() as $child) {
                $contactos[] = new Comentario(
                    $child->nombre->__toString(),
                    $child->correo->__toString(),
                    $child->mensaje->__toString(),
                    $child->fecha->__toString(),
                    $child->experiencia->__toString(),
                );
            }

            /**
             * PASO 4 -> Devolvemos el array de contactos
             */
            return array_reverse($contactos);
        } else {
            /**
             * PASO 1.1 -> Si no existe el fichero xml
             */
            throw new Exception('Error en la base de datos: No existe el fichero');
        }
    }

    public static function delete($id)
    {
        /**
         * La id hace referencia a la posicion de la array que tenemos que eliminar
         */
        $contactosArray = self::read();
        unset($contactosArray[$id]);
        /**  
         * volvemos a escribir todos los comentarios en el array
         */
        self::writeFromArray($contactosArray);
    }

    public static function writeFromArray($contactosArray)
    {
        $root = new SimpleXMLElement('<mensajes></mensajes>');
        foreach ($contactosArray as $contacto) {
            /**
             * PASO 4 -> CREAMOS LOS NODOS HIJOS DE CONTACTO
             */
            $nodoContacto = $root->addChild('contacto');
            $nodoContacto->addChild('mensaje', $contacto->getMensaje());
            $nodoContacto->addChild('experiencia', $contacto->getExperiencia());
            $nodoContacto->addChild('nombre', $contacto->getNombre());
            $nodoContacto->addChild('correo', $contacto->getEmail());
            $nodoContacto->addChild('correo', $contacto->getFecha());
        }


        try {
            $root->asXML(self::RUTA);
        } catch (Exception $e) {
            throw new Exception("No tienes permisos para escribir en el xml!");
        }
    }
}
