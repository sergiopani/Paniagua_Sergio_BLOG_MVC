<?php
class Model
{
    /**
     * Propiedades de la base de datos
     */
    private $host = 'localhost';
    private $user = 'root';
    private $password = ''; //En este caso root no tiene contraseña
    private $db = 'myweb';
    protected $conect; //Tiene protected para que puedan acceder las clases hijas
    private static $_instance;

    /**
     * PDO se utiliza para aceder diferentes bases de datos 
     */
    private function __construct()
    {
        $string_for_connection = "mysql:host=" . $this->host . ";
        dbname=" . $this->db . ";charset=utf8";

        try {
            $this->conect = new PDO($string_for_connection, $this->user, $this->password);
            /**
             * Establece el modo de manejo de excepciones
             * PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
             * Envez devolver un código de error o un mensaje de error,
             * se lanzará una excepción de tipo PDOException, 
             * lo cual permite un manejo más detallado y controlado del error.
             */
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            throw new Exception('Error: ' . $e->getMessage());
        }
    }

    /** 
     * Tengo que implementar el getInstance()
     * Con el patron singleton aseguramos
     * que solo exista una instancia de la clase  
     */
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }



    public function __destruct()
    {
        $this->conect = null;
    }
}