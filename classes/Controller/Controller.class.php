<?php
class Controller{
    public function __construct(){
        //Vaciado
    }

    /**
     * Function sanitize() -> Antes lo tenia en varias funciones, pero no era necesario
     * ahora lo paso todo a la misma funcion
     */
    function sanitize ($stringANetejar, $convertirAlowercase=0){
        if (strlen($stringANetejar)==0) {
            $stringANetejar = "";
        } else {
            $stringANetejar = trim($stringANetejar);
            $stringANetejar = htmlspecialchars(stripslashes(trim($stringANetejar, '-')));
            $stringANetejar = strip_tags($stringANetejar);
            // Preserve escaped octets.
            $stringANetejar = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $stringANetejar);
            // Remove percent signs that are not part of an octet.
            $stringANetejar = str_replace('%', '', $stringANetejar);
            // Restore octets.
            $stringANetejar = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $stringANetejar);
            
            switch ($convertirAlowercase) {
                case 1:
                    if (function_exists('mb_strtolower')) {
                        $stringANetejar = mb_strtolower($stringANetejar, 'UTF-8');
                    } else {
                        $stringANetejar = strtolower($stringANetejar);
                    }
                    break;
                case 2:
                    if (function_exists('mb_strtoupper')) {
                        $stringANetejar = mb_strtoupper($stringANetejar, 'UTF-8');
                    } else {
                        $stringANetejar = strtoupper($stringANetejar);
                    }
                    break;
                case 3:
                    if (function_exists('mb_strtoupper') && function_exists('mb_strtolower')) {
                        $stringANetejar = mb_strtolower($stringANetejar, 'UTF-8');
                        $stringANetejar[0] = mb_strtoupper($stringANetejar, 'UTF-8');
                        
                    } else {
                        $stringANetejar = strtolower($stringANetejar);
                        $stringANetejar[0] = strtoupper($stringANetejar[0]);
                    }
                    break;
                case 4:
                    if (function_exists('mb_strtoupper') && function_exists('mb_strtolower')) {
                        $stringANetejar = mb_strtolower($stringANetejar, 'UTF-8');
                        $stringANetejar[0] = mb_strtoupper($stringANetejar, 'UTF-8');
                        $inici=0;
                        while ($pos = strpos($stringANetejar, " ", $inici)) {
                            $inici=$pos+1;
                            $stringANetejar[$inici] = mb_strtoupper($stringANetejar[$inici], 'UTF-8');
                        }
                    } else {
                        $stringANetejar = strtolower($stringANetejar);
                        $stringANetejar[0] = strtoupper($stringANetejar[0]);
                        $inici=0;
                        while ($pos = strpos($stringANetejar, " ", $inici)) {
                            $inici=$pos+1;
                            $stringANetejar[$inici] = strtoupper($stringANetejar[$inici]);
                            
                        }
                    }
                    break;
            }
        }
        return $stringANetejar;
    }

    /**
     * Las funciones de validacion si que las dejo como las tenia
     */

     function validar_variables($variables){
        //validacion del select de genero
        switch ($variables['genero']) {
            case 'hombre':
                $variables['genero'] = 'hombre';
                break;

            case 'mujer':
                $variables['genero'] = 'mujer';
                break;
            default:
                $variables['genero'] = 'otros';
                break;
        }

        return $variables;
    }

    function validar_username($username){
        //Comprobar que el username no este vacio
        if (empty($username)) {
            return false;
        }

        //Comprobar con preg replace contenga letras entre A y Z        
        $username = preg_replace('/[^A-Za-z0-9]/', '', $username);

        return $username;
    }  

    function validar_email($email){
        //Comprobar que el email no este vacio
        if (empty($email)) {
            return false;
        }
        //Comprobar con preg replace contenga letras entre A y Z        
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        return $email;
    }

    function validar_password($password){

        //Comprobar que el password no este vacio
        if (empty($password)) {
            return false;
        }
        //Comprobar con preg replace contenga letras entre A y Z        
        $password = password_hash($password, PASSWORD_DEFAULT);

        return $password;
    }

    function validar_genero($genero){
        //Comprobar que el genero no este vacio
        if (empty($genero)) {
            return false;
        }
        //validacion del select de genero
        switch ($genero) {
            case 'hombre':
                $genero = 'hombre';
                break;

            case 'mujer':
                $genero = 'mujer';
                break;
            default:
                $genero = 'otros';
                break;
        }

        return $genero;
    }

    function validar_descripcion($descripcion)
    {
        //Comprobar con preg replace contenga letras entre A y Z        
        $descripcion = preg_replace('/[^A-Za-z0-9]/', '', $descripcion);
        return $descripcion;
    }

    function validar_direccion($direccion)
    {
        //Comprobar con preg replace contenga letras entre A y Z        
        $direccion = preg_replace('/[^A-Za-z0-9]/', '', $direccion);
        return $direccion;
    }

    function validar_telefono($telefono)
    {
        //Comprobar que contenga solo numeros
        $telefono = preg_replace('/[^0-9]/', '', $telefono);
        //Comprobar que sea de 9 digitos
        if (strlen($telefono) != 9) {
            return false;
        }
        return $telefono;
    }

    function validar_codigo_postal($codigo_postal)
    {
        //Comprobar que tenga 5 digitos y que sean solo numeros
        if (strlen($codigo_postal) != 5 || !is_numeric($codigo_postal)) {
            return false;
        }
        return $codigo_postal;
    }

    function validar_provincia($provincia)
    {
        global $capitales;
        //Si en las keys de capitales existe la provincia
        if (array_key_exists($provincia, $capitales)) {
            return $provincia;
        }

        return false;
    }


    function validar_poblacion($poblacion)
    {
        global $capitales;
        //Si en los values de capitales existe la poblacion
        if (in_array($poblacion, $capitales)) {
            return $poblacion;
        }

        return false;
    }

    function validarExperiencia($experiencia)
    {
        /***
         * 1 -> La experiencia no puede estar vacia ya que el select no tiene opciones vacias
         * 2-> La experincia tiene que estar en los valores del select
         * 
         */
        if (empty($experiencia)) {

            return 'La experiencia no puede estar vacia';
        }

        $experiencia = strtoupper($experiencia);
        switch ($experiencia) {
            case 'MALA':
                break;
            case 'MEH':
                break;
            case 'BUENA':
                break;
            case 'MUY BUENA':
                break;
            default:  return 'La experiencia no es correcta';                
        }
    }

    function validarNombre($nombre)
    {
        /***
         * 1 -> El nombre no puede estar vacio
         * 2-> El nombre tiene que tener menos de 50 caracteres
         * 3 -> El nombre no puede contener numeros
         * 4 -> EL nombre no puede contener caracteres especiales
         */
        if (empty($nombre)) {

            return 'El nombre no puede estar vacio';
        }
        if (strlen($nombre) > 50) {

            return 'El nombre no puede tener mas de 50 caracteres';
        }

        if (preg_match('/[0-9]/', $nombre)) {
            return 'El nombre no puede contener numeros';
        }

        if (preg_match('/[^A-Za-z\s]/', $nombre)) {
            return 'El nombre no puede contener caracteres especiales';
        }
    }

    function validarCorreo($correo)
    {
        /***
         * 1 -> El correo no puede estar vacio
         * 2-> El correo tiene que tener menos de 50 caracteres
         * 3 -> El correo tiene que tener un formato correcto
         */
        if (empty($correo)) {

            return 'El correo no puede estar vacio';
        }
        if (strlen($correo) > 50) {

            return 'El correo no puede tener mas de 50 caracteres';
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return 'El correo no tiene un formato correcto';
        }
    }

    
}