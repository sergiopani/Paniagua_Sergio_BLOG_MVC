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
            //!Crear nueva clase Conexion??
            self::$connection = new mysqli($host, $username, $password, $dbname);
        } catch (mysqli_sql_exception $e) {
            throw new Exception("Error de conexion a la base de datos");
        }
    }

    public static function insert(BlogUser $user)
    {
        try {
            $query = 'INSERT INTO tbl_usuaris (email, password, tipusIdent, numeroIdent, nom, 
        cognoms, sexe, naixement, adreca, codiPostal, poblacio, provincia, 
        telefon, imatge, status, navegador, plataforma) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = self::$connection->prepare($query);
            $params = array(
                $user->getEmail(), $user->getPassword(), $user->getTipusIdent(),
                $user->getNumeroIdent(), $user->getNom(), $user->getCognoms(), $user->getSexe(), $user->getNaixement(), $user->getAdreca(), $user->getCodiPostal(),
                $user->getPoblacio(), $user->getProvincia(), $user->getTelefon(), $user->getImatge(), $user->getStatus(), $user->getNavegador(), $user->getPlataforma()
            );
            /**
             * Call_user_func_array() -> Ejecuta la funcion bind_param de la clase mysqli_stmt
             * pasandole como parametro un array con los datos a insertar
             * lo que hace es substuir los interrogantes por los datos que tenemos en la array para 
             * insertarlos
             */
            call_user_func_array(array($stmt, 'bind_param'), ['sssssssssssssisss', ...$params]);
            $stmt->execute();
            return [true, 'Usuario insertado correctamente'];
        } catch (Exception $e) {
            return [false, 'Error al insertar el usuario: ' . $stmt->error];
        } finally {
            self::$connection->close();
        }

        return [true, 'Usuario insertado correctamente'];
    }

    public static function numeroIdentExists($numeroIdent)
    {
        try {
            $count = 0;
            $query = 'SELECT COUNT(*) FROM tbl_usuaris WHERE numeroIdent = ?';
            $stmt = self::$connection->prepare($query);
            $params = array('s', &$numeroIdent);
            call_user_func_array(array($stmt, 'bind_param'), $params);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            return [!($count > 0), ''];
        } catch (Exception $e) {
            return [false, 'Error comprobando si exite el usuario: ' . $stmt->error];
        } finally {

            //Cerramos la conexion de base de datos
            self::$connection->close();
        }
    }

    public static function emailExists($email)
    {
        try {
            $count = 0;
            $query = 'SELECT COUNT(*) FROM tbl_usuaris WHERE email = ?';
            $stmt = self::$connection->prepare($query);
            $params = array('s', &$email);
            call_user_func_array(array($stmt, 'bind_param'), $params);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            return [!($count > 0), ''];
        } catch (Exception $e) {
            return [false, 'Error comprobando si exite el email: ' . $stmt->error];
        } finally {
            //Cerramos la conexion de base de datos
            self::$connection->close();
        }
    }



    public static function checkCredentials($email, $password)
    {
        try {
            // Verifica si el nombre de usuario y la contraseña son válidos
            $count = 0;
            $stmt = self::$connection->prepare('SELECT COUNT(*) FROM tbl_usuaris WHERE email = ? AND password = ?');
            $stmt->bind_param('ss', $email, $password);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
        } catch (Exception $e) {
            return [false, 'Error comprobando las credenciales: ' . $stmt->error];
        } finally {
            //Cerramos la conexion de base de datos
            self::$connection->close();

            return [!$count > 0, ''];
        }
    }

    public static function createSession($email)
    {


        // Almacena el nombre de usuario en una variable de sesión
        $_SESSION['email'] = $email;
        $_SESSION['message'] = 'Bienvenido ' . $email;
        $_SESSION['message_type'] = 'success';
    }
}
