<?php

class BlogUserModel
{

    private static $connection;

    public function __construct()
    {
    }

    public static function create_connection($host, $dbname, $username, $password)
    {

        try {
            self::$connection = new mysqli($host, $username, $password, $dbname);
        } catch (mysqli_sql_exception $e) {
            throw new Exception("Error de conexion a la base de datos", $e->getMessage());
        }
    }

    public static function insert(BlogUser $user)
    {
        $query = 'INSERT INTO tbl_usuaris (email, password, tipusIdent, numeroIdent, nom, cognoms, sexe, naixement, adreca, codiPostal, poblacio, provincia, telefon, imatge, status, navegador, plataforma) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = self::$connection->prepare($query);
        $params = array(
            'sssssssssssssiss', $user->getEmail(), $user->getPassword(), $user->getTipusIdent(), $user->getNumeroIdent(), $user->getNom(), $user->getCognoms(), $user->getSexe(), $user->getNaixement(), $user->getAdreca(), $user->getCodiPostal(),
            $user->getPoblacio(), $user->getProvincia(), $user->getTelefon(), $user->getImatge(), $user->getStatus(), $user->getNavegador(), $user->getPlataforma()
        );
        call_user_func_array(array($stmt, 'bind_param'), $params);
        $stmt->execute();
    }

    public static function usernameExists($username)
    {
        $count = 0;
        $query = 'SELECT COUNT(*) FROM tbl_usuaris WHERE username = ?';
        $stmt = self::$connection->prepare($query);
        $params = array('s', &$username);
        call_user_func_array(array($stmt, 'bind_param'), $params);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        return $count > 0;
    }

    public static function emailExists($email)
    {
        $count = 0;
        $query = 'SELECT COUNT(*) FROM tbl_usuaris WHERE email = ?';
        $stmt = self::$connection->prepare($query);
        $params = array('s', &$email);
        call_user_func_array(array($stmt, 'bind_param'), $params);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        return $count > 0;
    }

    // public function checkCredentials($username, $password)
    // {
    //     // Verifica si el nombre de usuario y la contraseña son válidos
    //     $stmt = $this->connection->prepare('SELECT COUNT(*) FROM usuarios WHERE username = ? AND password = ?');
    //     $stmt->bind_param('ss', $username, $password);
    //     $stmt->execute();
    //     $stmt->bind_result($count);
    //     $stmt->fetch();
    //     return (int) $count > 0;
    // }
}
