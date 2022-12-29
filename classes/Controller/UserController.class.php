<?php
class UserController extends Controller
{
    public function __construct()
    {
    }

    public function register()
    {
        /**
         * Igual que estaba anteriormente en el archivo de rehistro.php
         */
        //Array asociativo de errroes de subida de imagen
        $errores_subida_imagen = [
            0 => 'No hay error, la subida se ha realizado con éxito',
            1 => 'El tamaño del archivo excede el permitido por el servidor',
            2 => 'El tamaño del archivo excede el permitido por el cliente',
            3 => 'El envío de archivo se interrumpió durante la transferencia',
            4 => 'No se ha enviado ningún archivo',
            6 => 'No existe un directorio temporal donde subir el archivo',
            7 => 'No se ha podido escribir el archivo en el disco',
            8 => 'Una extensión PHP evito la subida del archivo',
        ];

        //Almacena los errores como variable
        $error = 0;
        /********VALIDAMOS TODO *****************/
        $variables_corregidas = array();

        //PASO 4 -> Sanitizamos y despues validamos los datos que nos vienen por post
        if (isset($_POST['username']) && !empty($_POST['username'])) {
            $variables_corregidas['username'] = $this->validar_username($this->sanitize($_POST['username'], 1));
        } else $error = 1;

        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $variables_corregidas['email'] = $this->validar_email($this->sanitize($_POST['email'], 1));
        } else $error = 1;

        if (isset($_POST['password']) && !empty($_POST['password'])) {
            $variables_corregidas['password'] = $this->validar_password($this->sanitize($_POST['password'], 1));
        } else $error = 1;

        if (isset($_POST['genero']) && !empty($_POST['genero'])) {
            $variables_corregidas['genero'] = $this->validar_genero($this->sanitize($_POST['genero'], 1));
        } else $error = 1;

        //Las que no son obligatorias
        //Adreça, codi postal, població, provincia i telèfon (opcionals)
        if (isset($_POST['direccion']) && !empty($_POST['direccion'])) {
            $variables_corregidas['direccion'] = $this->validar_direccion($this->sanitize($_POST['direccion']));
            if ($variables_corregidas['direccion'] == false) {
                $error = 1;
            }
        }

        if (isset($_POST['cp']) && !empty($_POST['cp'])) {
            $variables_corregidas['codigo_postal'] = $this->validar_codigo_postal($this->sanitize($_POST['cp']));
            if ($variables_corregidas['codigo_postal'] == false) {
                $error = 1;
            }
        }

        if (isset($_POST['poblacion']) && !empty($_POST['poblacion'])) {
            $variables_corregidas['poblacion'] = $this->validar_poblacion($this->sanitize($_POST['poblacion']));
            if ($variables_corregidas['poblacion'] == false) {
                $error = 1;
            }
        }

        if (isset($_POST['provincia']) && !empty($_POST['provincia'])) {
            $variables_corregidas['provincia'] = $this->validar_provincia($this->sanitize($_POST['provincia']));
            if ($variables_corregidas['provincia'] == false) {
                $error = 1;
            }
        }

        if (isset($_POST['telefono']) && !empty($_POST['telefono'])) {
            $variables_corregidas['telefono'] = $this->validar_telefono($this->sanitize($_POST['telefono']));
            if ($variables_corregidas['telefono'] == false) {
                $error = 1;
            }
        }

        /**
         * Creamos el ususario
         */
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $error == 0) {
            $user = new User(
                $variables_corregidas['username'],
                $variables_corregidas['email'],
                $variables_corregidas['password'],
                $variables_corregidas['genero'],
                $variables_corregidas['direccion'],
                $variables_corregidas['codigo_postal'],
                $variables_corregidas['poblacion'],
                $variables_corregidas['provincia'],
                $variables_corregidas['telefono'],
                null
            );

            //Guardamos el usuario en el xml
            if (UserModel::create($user)) {
                $message = 'Usuario creado correctamente sin imagen';
                $message_type = 'alert-success';
            }
        }

        if (isset($_FILES['imagen']) && !empty($_FILES['imagen']['name']) && $error == 0) {
            /********IMAGEN *************/
            //PASO 0 -> Comprobamos si hay errores en la subida de la imagen
            if ($_FILES['imagen']['error'] != 0) {
                $error = 3;
            } else {
                // var_dump($_FILES['imagen']);
                //PASO 1 -> Miramos si la imagen tiene la extension correcta y si no existe en el la carpeta
                //Miramos si nos viene algo por $_files
                if (
                    $this->verificar_extension($_FILES['imagen']) &&
                    (!$this->existe_fichero($_FILES['imagen']['name'])) && $this->size_maximo($_FILES['imagen']['size'])
                ) {
                    //PASO 2 -> Añadimos la ruta de la carpeta a la imagen, con la fecha inclida             
                    $ruta_a_guardar = 'imgs/user-images/'
                        . date('Y-m-d') . '-'
                        . $_FILES['imagen']['name'];

                    //PASO 3 -> Guardamos la imagen en la carpeta            
                    $this->guardar_imagen($ruta_a_guardar);

                    // $user->imagen = $ruta_a_guardar;

                    $message = "Usuario creado correctamente con imagen";
                    $message_type = 'alert-success';
                    // $_SESSION['message'] = 'Te has registrado correctamente!';
                    // $_SESSION['message_type'] = 'alert-success';
                    // header("Location: ../index.php");

                    //PASO 4 -> Guardamos en la session para poder recojer el tipo de imagen desde la home page

                } else {
                    //Eror de que no ha pasado el if de arriba
                    $error = 2;
                }
            }
        }

        //Si no hay cabezera POST no hacemos nada
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($error == 1) {
                $message = 'Rellena todos los campos obligatorios*';
                $message_type = 'alert-danger';
            } else if ($error == 2) {
                $message = 'La extension de la imagen no es correcta';
                $message_type = 'alert-danger';
            } else if ($error == 3) {
                $message = $errores_subida_imagen[$_FILES['imagen']['error']];
                $message_type = 'alert-danger';
            }
        }


        $vista = new UserView();
        if (isset($message) && isset($message_type)) {
            $vista->registre($message, $message_type);
        } else {
            $vista->registre();
        }
    }

    function guardar_imagen($imagen_url)
    {
        //PASO 1 -> Movemos la imagen de la carpeta temporal a la carpeta definitiva
        move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_url);
    }
}
