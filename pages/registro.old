<?php

require_once 'funciones.php';
require_once 'header.php';

// ini_set('display_errors', 1);

session_start();

$message = '';
$message_type = '';
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
    $variables_corregidas['username'] = validar_username(sanitizar_generico($_POST['username']));
} else $error = 1;

if (isset($_POST['email']) && !empty($_POST['email'])) {
    $variables_corregidas['email'] = validar_email(sanitizar_generico($_POST['email']));
} else $error = 1;

if (isset($_POST['password']) && !empty($_POST['password'])) {
    $variables_corregidas['password'] = validar_password(sanitizar_password($_POST['password']));
} else $error = 1;

if (isset($_POST['genero']) && !empty($_POST['genero'])) {
    $variables_corregidas['genero'] = validar_genero(sanitizar_generico($_POST['genero']));
} else $error = 1;

//Las que no son obligatorias
//Adreça, codi postal, població, provincia i telèfon (opcionals)
if (isset($_POST['direccion']) && !empty($_POST['direccion'])) {
    $variables_corregidas['direccion'] = validar_direccion(sanitizar_generico($_POST['direccion']));
    if ($variables_corregidas['direccion'] == false) {
        $error = 1;
    }
}

if (isset($_POST['codigo_postal']) && !empty($_POST['codigo_postal'])) {
    $variables_corregidas['codigo_postal'] = validar_codigo_postal(sanitizar_generico($_POST['codigo_postal']));
    if ($variables_corregidas['codigo_postal'] == false) {
        $error = 1;
    }
}

if (isset($_POST['poblacion']) && !empty($_POST['poblacion'])) {
    $variables_corregidas['poblacion'] = validar_poblacion(sanitizar_generico($_POST['poblacion']));
    if ($variables_corregidas['poblacion'] == false) {
        $error = 1;
    }
}

if (isset($_POST['provincia']) && !empty($_POST['provincia'])) {
    $variables_corregidas['provincia'] = validar_provincia(sanitizar_generico($_POST['provincia']));
    if ($variables_corregidas['provincia'] == false) {
        $error = 1;
    }
}

if (isset($_POST['telefono']) && !empty($_POST['telefono'])) {
    $variables_corregidas['telefono'] = validar_telefono(sanitizar_generico($_POST['telefono']));
    if ($variables_corregidas['telefono'] == false) {
        $error = 1;
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
            verificar_extension($_FILES['imagen']) &&
            (!existe_fichero($_FILES['imagen']['name'])) && size_maximo($_FILES['imagen']['size'])
        ) {
            //PASO 2 -> Añadimos la ruta de la carpeta a la imagen, con la fecha inclida             
            $ruta_a_guardar = '../imgs/user-images/'
                . date('Y-m-d') . '-'
                . $_FILES['imagen']['name'];

            //PASO 3 -> Guardamos la imagen en la carpeta            
            guardar_imagen($ruta_a_guardar);


            //PASO 3.1 -> Guardamos en el xml de registrados  las variables corregidas
            /////NO esta hecho de momento
            // escribir_en_fichero('../XmlData/registrados.xml',  $variables_corregidas);


            //PASO 4 -> Guardamos en la session para poder recojer el tipo de imagen desde la home page
            $_SESSION['message'] = 'Te has registrado correctamente!';
            $_SESSION['message_type'] = 'alert-success';

            header("Location: ../index.php");
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


function guardar_imagen($imagen_url)
{
    //PASO 1 -> Movemos la imagen de la carpeta temporal a la carpeta definitiva
    move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_url);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <!-- <link rel="stylesheet" href="styles/pages/home.css" /> -->

    <style>
        form {

            width: 500px;
            margin: 150px auto;
            text-align: center;
            position: relative;
        }

        fieldset {
            background: white;
            border: 0 none;
            border-radius: 3px;
            box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
            padding: 20px 30px;
            box-sizing: border-box;
            width: 80%;
            margin: 0 10%;

            /*stacking fieldsets above each other*/
            position: relative;
        }

        input {
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            font-size: 13px;

        }

        button {
            width: 100px;
            background: #27AE60;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 1px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }

        .alert-success {
            padding: 20px;
            background-color: #27AE60;
            color: white;
            margin-top: 100px;
            z-index: -10;
        }

        .alert-danger {
            padding: 20px;
            background-color: #c0392b;
            color: white;
            margin-top: 100px;
            z-index: -10;

        }

        span {
            color: red;
        }
    </style>
</head>

<body>
    <!--Lanzamos una alerta con el mensaje hemos guardado en $_SESION -->
    <?php
    if (!empty($message)) {
        echo "<div class=" . $message_type . ">"  . $message . "</div>";
    }

    $username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
    $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
    $dni = isset($_REQUEST['dni']) ? $_REQUEST['dni'] : '';

    ?>

    <!--EL enctype se utiliza para aceptar ficheros-->
    <form id="registro" action="registro.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <!--USERNAME -->
            <label for="username">Introduce tu username:<span>*</span> </label><br>
            <input type="text" name="username" id="username" value="<?php echo $username; ?>"><br>
            <!--PASSWORD -->
            <label for="password">Introduce tu contraseña: <span>*</span></label><br>
            <input type="password" name="password" id="password" value="<?php echo $email; ?>"><br>
            <!--EMAIL-->
            <label for="email">Introduce tu correo: <span>*</span></label>
            <input type="email" name="email" id="email" value="<?php echo $password; ?>">
            <!--DNI-->
            <label for="dni">Introduce tu DNI: <span>*</span></label>
            <input type="text" name="dni" id="dni" value="<?php echo $dni; ?>"><br>

            <!--SELECT-->
            <label for="genero">Genero:</label>
            <select name="genero" id="genero">
                <option value="hombre">Hombre</option>
                <option value="mujer">Mujer</option>
                <option value="otros">Otros....</option>
            </select><br><br>

            <!--Adreça, codi postal, població, provincia i telèfon (opcionals)-->
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="direccion"><br>
            <label for="cp">Código Postal:</label>
            <input type="text" name="cp" id="cp"><br>
            <label for="poblacion">Población:</label>
            <input type="text" name="poblacion" id="poblacion"><br>
            <label for="provincia">Provincia:</label>
            <input type="text" name="provincia" id="provincia"><br>
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono"><br>

            <!--IMAGEN DEL USUARIO-->
            <label for="imagen">Imagen del usuario:</label>
            <input type="file" name="imagen" id="imagen"><br><br>

            <!--SUBMIT -->
            <button type="submit" id="submit">Enviar Datos</button>
        </fieldset>
    </form>


</body>

</html>