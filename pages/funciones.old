<?php
include_once 'poblaciones.php';




/******FICHERO CON TODAS LAS FUNCIONES COMUNAS entre formulario y registro *********/
function escribir_en_fichero($document_name, $variables_array)
{
    //Escribir en un fichero de texto
    //Abrimos el fichero
    $file = fopen($document_name, 'a+');

    $resultado_fichero = "";

    //Obtener la fehca actual
    $fecha = date('d-m-Y H:i:s');

    /*****TODO ESTE PROCESO ES PARA PONER LA ETIQUETA ROOT DE <USUARIOS></USUARIOS> */
    //Si el fichero $file se encuentra vacio
    if (filesize($document_name) == 0) {
        //Escribimos 
        $resultado_fichero .= "<usuarios>";
    } else {
        //Cojemos toda la data del document html
        $data = file_get_contents($document_name);
        //Borramos los 11 ultimos caracteres del fichero
        $data = substr($data, 0, filesize($document_name) - 11);
        file_put_contents($document_name, $data);
    }

    $resultado_fichero .= "<usuario> 
    <username>" . $variables_array['username'] . "</username>
    <email>" . $variables_array['email'] . "</email>
    <password>" . $variables_array['password'] . "</password>
    <genero>" . $variables_array['genero'] . "</genero>
    <descripcion>" . $variables_array['descripcion'] . "</descripcion>   
    <fecha>" . $fecha . "</fecha>
    </usuario></usuarios>";

    //Escribimos en el fichero
    fwrite($file, $resultado_fichero);
    //Set the file pointer to exact position 

    //Cerramos el fichero
    fclose($file);
}



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


function sanitizar_password($password)
{
    $password = password_hash($password, PASSWORD_DEFAULT);
    return $password;
}

//Funcion con funciones genericas para sanitizar
//Asi no tengo que repetir codigo
function sanitizar_generico($variable)
{
    $variable = trim($variable);
    $variable = htmlspecialchars($variable);
    $variable = strip_tags($variable);
    return $variable;
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

function size_maximo($imagen_url)
{
    //PASO 1 -> Obtenemos el tamaño de la imagen
    $size = filesize($imagen_url);

    //PASO 2 -> Comprobamos si el tamaño es mayor que 2MB
    if ($size > 1000000) {
        return false;
    } else {
        return true;
    }
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

function verificar_extension($image)
{
    //PASO 1 -> Guardamos todas las extensiones corectas en un array
    $extensiones = array("image/jpg", "image/png", "image/jpeg", "image/gif");
    $extension_verdadera = pathinfo($image['name']);
    var_dump($image['type']);
    //PASO 2 -> Si el typo del archivo es correcto
    if (in_array($image['type'], $extensiones)) {
        echo "La extension es correcta";
        return true;
    }

    //PASO 5 -> Si no es correcto devolvemos false  
    return false;
}

/*********FUNCIONES DE LA TABLA DE LOS MUERTOS ***************/
function sanitizarMensaje($mensaje)
{
    $mensaje = trim($mensaje);
    $mensaje = htmlspecialchars($mensaje);
    $mensaje = strip_tags($mensaje);
    return $mensaje;
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


function sanitizarExperiencia($experiencia)
{
    $experiencia = trim($experiencia);
    $experiencia = htmlspecialchars($experiencia);
    $experiencia = strip_tags($experiencia);
    return $experiencia;
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
            break;
    }
}


function sanitizarNombre($nombre)
{
    $nombre = trim($nombre);
    $nombre = htmlspecialchars($nombre);
    $nombre = strip_tags($nombre);
    return $nombre;
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

function sanitizarCorreo($correo)
{
    $correo = trim($correo);
    $correo = htmlspecialchars($correo);
    $correo = strip_tags($correo);
    return $correo;
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

function htmlGenerateContactos($contactos)
{
    /**
     * PASO 1 -> ESTO ES LO QUE QUIERO GENERAR
     */
    // <div class="table-data">EJEMPLO</div>
    $resultado = '';
    /**
     * PASO 2 -> GENERAR EL HTML como tantos contactos como tenga el array
     */
    for ($i = 0; $i < count($contactos); $i++) {
        $resultado .=  '<div class="own-table-row">' .
            '<div class="table-data">' .
            $contactos[$i]->getMensaje() . '</div>' .
            '<div class="table-data">' .
            $contactos[$i]->getExperiencia() . '</div>' .
            '<div class="table-data">' .
            $contactos[$i]->getNombre() . '</div>' .
            '<div class="table-data">' .
            $contactos[$i]->getEmail() . '</div>' .
            '<div class="table-data">' . $contactos[$i]->getFecha() . '</div>' .
            '</div>';
    }

    return $resultado;
}
