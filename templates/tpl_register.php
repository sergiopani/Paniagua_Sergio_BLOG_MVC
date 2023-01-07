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
    <form id="registro" action="?user/register" method="post" enctype="multipart/form-data">
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
