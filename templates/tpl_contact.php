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

<body>
    <!--Lanzamos una alerta con el mensaje hemos guardado en $_SESION -->
    <?php
    if (!empty($message)) {
        echo "<div class=" . $message_type . ">"  . $message . "</div>";
    }
    ?>



    <form action="?contact/show" method="post">
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
            <button type="submit" name="boto">Enviar Datos</button>
        </fieldset>
    </form>


</body>