<?php

require_once 'funciones.php';
include_once 'header.php';


// ini_set('display_errors', 1);
session_start();
$error = 0;
//El mensaje que vamos a mostrar en rojo o en verde
$message = '';
$message_type = '';

$variables_corregidas = array();
//Validmos y sanitizamos los datos que nos vienen por post
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

if (isset($_POST['descripcion']) && !empty($_POST['descripcion'])) {
    $variables_corregidas['descripcion'] = validar_descripcion(sanitizar_generico($_POST['descripcion']));
    //esta no es obligatoria
}




//Si no hay errores, es decir, si el valor de $error es 0, entonces procedemos a guardar los datos en el xml
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($error == 0) {
        escribir_en_fichero('../XmlData/usuarios.xml',  $variables_corregidas);

        $message = 'Se ha enviado correctamente la solicitud!';
        $message_type = 'alert-success';
    } else {
        //Si hay errores, entonces mostramos el mensaje de error
        $message = 'No has rellenado todos los campos obligatorios *';
        $message_type = 'alert-danger';
    }
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
            margin: 120px auto;
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
        }

        .alert-danger {
            padding: 20px;
            background-color: #c0392b;
            color: white;
            margin-top: 100px;
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
    ?>



    <form action="formulario.php" method="post">
        <fieldset>
            <!--USERNAME -->
            <label for="username">Introduce tu username:<span>*</span> </label><br>
            <input type="text" name="username" id="username"><br>
            <!--PASSWORD -->
            <label for="password">Introduce tu contraseña: <span>*</span></label><br>
            <input type="password" name="password" id="password"><br>
            <!--EMAIL-->
            <label for="email">Introduce tu correo: <span>*</span></label>
            <input type="email" name="email" id="email"><br>
            <!--TEXTAREA-->
            <label for="descripcion">Que quieres preguntar? <span>*</span></label><br>
            <textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea><br>
            <!--CHECKBOX-->
            <label for="checkbox">Eres mayor de edad? <span>*</span></label>
            <input type="checkbox" name="checkbox" id="checkbox" style="height:20px;"><br><br>
            <!--SELECT-->
            <label for="genero">Genero:</label>
            <select name="genero" id="genero">
                <option value="hombre">Hombre</option>
                <option value="mujer">Mujer</option>
                <option value="otros">Otros....</option>
            </select><br><br>

            <!--SUBMIT -->
            <button type="submit">Enviar Datos</button>
        </fieldset>
    </form>


</body>

</html>