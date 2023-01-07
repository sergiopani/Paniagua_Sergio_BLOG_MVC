<?php
class Controller
{
    protected $env;

    public function __construct()
    {
        /**
         * Si se produce 
         * una excepcion en alguno de los controladores
         * voy a llamar a la pagina de error view
         * Las excepciones se pueden producir por ejemplo cuando el Controlador
         * llama al modelo, y este a su vez llama a la base de datos, y esta no responde
         */
        set_exception_handler(array($this, 'handleException'));

        $this->env = parse_ini_file('config.env');
    }

    public function handleException($exception)
    {

        $exception = new Exception($exception->getMessage());
        $vista = new ErrorView($exception);
        $vista->show();
    }

    public function save_image($image)
    {

        if (isset($image)) {
            $file = $image;
            $file_name = $file['name'];
            $file_type = $file['type'];
            $file_tmp_name = $file['tmp_name'];
            $file_error = $file['error'];
            $file_size = $file['size'];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            $allowed = array('jpg', 'jpeg', 'png');

            if (in_array($file_ext, $allowed)) {
                if ($file_error === 0) {
                    if ($file_size <= 2097152) {
                        $file_name_new = uniqid('', true) . '.' . $file_ext;
                        $file_destination = 'imgs/user-images/' . $file_name_new;
                        if (move_uploaded_file($file_tmp_name, $file_destination)) {

                            return [true, $file_name_new];
                        } else {
                            $errores['imagen'] = 'Hubo un error al subir la imagen';
                        }
                    } else {
                        $errores['imagen'] = 'La imagen es demasiado grande';
                    }
                } else {
                    $errores['imagen'] = 'Hubo un error al subir la imagen';
                }
            } else {
                $errores['imagen'] = 'La imagen no es valida';
            }
        }

        return [false, $errores['imagen']];
    }


    public function getDataFile($file)
    {
        $file = "data/$file.php";
        if (file_exists($file)) {
            return $file;
        } else {
            throw new Exception("No existe el fichero de datos $file");
        }
    }
    /**
     * 
     * Mi funcion sanitize 
     */
    public function sanitize_values($value, $type = null)
    {
        //si es de tipo string y esta vacio
        if ($type == 'string' && strlen($value) == 0) {
            $value = "";
        }
        $value = trim($value);
        $value = htmlspecialchars(stripslashes(trim($value, '-')));
        $value = strip_tags($value);

        $value = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $value);

        $value = str_replace('%', '', $value);

        $value = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $value);

        switch ($type) {
            case 'text':
                // Quita etiquetas HTML y PHP
                $value = htmlspecialchars($value, ENT_QUOTES);
                break;
            case 'int':
                // Convierte el valor a un entero
                $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
                break;
            case 'email':
                // Quita etiquetas y convierte caracteres no válidos en el formato de correo electrónico a caracteres válidos
                $value = filter_var($value, FILTER_SANITIZE_EMAIL);
                break;
            case 'float':
                // Convierte el valor a un número de coma flotante
                $value = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                break;
            case 'password':
                // Quita caracteres especiales
                $value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
                break;
            case 'identificacion':
                // Quita caracteres especiales
                $value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
                break;
        }
        return $value;
    }

    /**
     * FUNCTION DE TONI 
     */
    function sanitize($value, $convertirAlowercase = 0)
    {
        if (strlen($value) == 0) {
            $value = "";
        } else {
            $value = trim($value);
            $value = htmlspecialchars(stripslashes(trim($value, '-')));
            $value = strip_tags($value);
            // Preserve escaped octets.
            $value = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $value);
            // Remove percent signs that are not part of an octet.
            $value = str_replace('%', '', $value);
            // Restore octets.
            $value = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $value);

            switch ($convertirAlowercase) {
                case 1:
                    if (function_exists('mb_strtolower')) {
                        $value = mb_strtolower($value, 'UTF-8');
                    } else {
                        $value = strtolower($value);
                    }
                    break;
                case 2:
                    if (function_exists('mb_strtoupper')) {
                        $value = mb_strtoupper($value, 'UTF-8');
                    } else {
                        $value = strtoupper($value);
                    }
                    break;
                case 3:
                    if (function_exists('mb_strtoupper') && function_exists('mb_strtolower')) {
                        $value = mb_strtolower($value, 'UTF-8');
                        $value[0] = mb_strtoupper($value, 'UTF-8');
                    } else {
                        $value = strtolower($value);
                        $value[0] = strtoupper($value[0]);
                    }
                    break;
                case 4:
                    if (function_exists('mb_strtoupper') && function_exists('mb_strtolower')) {
                        $value = mb_strtolower($value, 'UTF-8');
                        // $value[0] = mb_strtoupper($value, 'UTF-8');
                        $inici = 0;
                        while ($pos = strpos($value, " ", $inici)) {
                            $inici = $pos + 1;
                            $value[$inici] = mb_strtoupper($value[$inici], 'UTF-8');
                        }
                    } else {
                        $value = strtolower($value);
                        $value[0] = strtoupper($value[0]);
                        $inici = 0;
                        while ($pos = strpos($value, " ", $inici)) {
                            $inici = $pos + 1;
                            $value[$inici] = strtoupper($value[$inici]);
                        }
                    }
                    break;
            }
        }
        return $value;
    }

    /**
     * Las funciones de validacion si que las dejo como las tenia
     */

    function validar_variables($variables)
    {
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

    function validar_username($username)
    {
        //Comprobar que el username no este vacio
        if (empty($username)) {
            return false;
        }

        //Comprobar con preg replace contenga letras entre A y Z        
        $username = preg_replace('/[^A-Za-z0-9]/', '', $username);

        return $username;
    }

    function validar_idioma($idioma)
    {
        if (
            $idioma == 'es' || $idioma == 'en' || $idioma == 'xn' || $idioma == 'fr' || $idioma = 'al'

        ) {
            return $idioma;
        }
        //Si no es ninguno de los anteriores,devolvemos false
        return false;
    }

    function validar_email($email)
    {
        //Comprobar que el email no este vacio
        if (empty($email)) {
            return false;
        }
        //Comprobar con preg replace contenga letras entre A y Z        
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        return $email;
    }

    function validar_password($password)
    {

        //Comprobar que el password no este vacio
        if (empty($password)) {
            return false;
        }
        //Comprobar con preg replace contenga letras entre A y Z        
        $password = password_hash($password, PASSWORD_DEFAULT);

        return $password;
    }

    function validar_genero($genero)
    {
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

        // include_once $this->getDataFile('poblaciones');
        //Si en las keys de capitales existe la provincia
        // if (array_key_exists($provincia, $capitales)) {
        //     return $provincia;
        // }

        return true;
    }


    function validar_poblacion($poblacion)
    {
        include_once $this->getDataFile('poblaciones');

        //Si en los values de capitales existe la poblacion
        if (in_array($poblacion, $capitales)) {
            return $poblacion;
        }

        return true;
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
            default:
                return 'La experiencia no es correcta';
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

    function verificar_extension($image)
    {
        //PASO 1 -> Guardamos todas las extensiones corectas en un array
        $extensiones = array("image/jpg", "image/png", "image/jpeg", "image/gif");
        $extension_verdadera = pathinfo($image['name']);
        // var_dump($image['type']);
        //PASO 2 -> Si el typo del archivo es correcto
        if (in_array($image['type'], $extensiones)) {
            // echo "La extension es correcta";
            return true;
        }

        //PASO 5 -> Si no es correcto devolvemos false  
        return false;
    }

    function existe_fichero($imagen_url)
    {
        //PASO 1 -> Montamos la url del fichero
        $imagen_url = 'imgs/user-images/' . $imagen_url;

        //PASO 2 -> Comprobamos si existe el fichero
        if (file_exists($imagen_url)) {
            return true;
        }

        //PASO 3 -> Si no existe devolvemos false
        return false;
    }

    function size_maximo($size)
    {
        //PASO 1 -> Obtenemos el tamaño de la imagen
        // $size = filesize($imagen_url);

        //PASO 2 -> Comprobamos si el tamaño es mayor que 2MB
        if ($size > 1000000) {
            return false;
        } else {
            return true;
        }
    }

    function validarMensaje($mensaje)
    {
        /***
         * 1 -> El mensaje no puede estar vacio ( A los muertos siempre se les habla)
         * 2-> EL mensaje tiene que tener menos de 200 caracteres
         * 
         */
        if (empty($mensaje)) {

            return 'El mensaje no puede estar vacio';
        }
        if (strlen($mensaje) > 200) {

            return 'El mensaje no puede tener mas de 200 caracteres';
        }
    }
}
