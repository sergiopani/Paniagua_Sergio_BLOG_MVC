
<style>
    @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700');


    *,
    *:before,
    *:after {
        box-sizing: border-box;
    }

    body {

        font-family: 'Source Sans Pro', sans-serif;
        margin: 0;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin: 0;
    }

    .table {
        width: 100%;

    }

    .table-header {
        display: flex;
        width: 100%;
        background: #000;

    }


    .table-row {
        display: flex;
        width: 100%;

    }

    .own-table-row {
        display: flex;
        width: 100%;
        /**Beautiful styles */
        border: 1px solid #000;

        font-weight: 700;
        font-size: 1.2em;
        padding: 1em;

    }

    button {
        width: auto;
        height: 50px;
        /**CENTRAR EL BOTON*/


    }

    .table-data {
        /* width: 25%; */
        /* padding: 1em; */
        /* border: 1px solid #000; */
        font-weight: 700;
        font-size: 1.2em;
        /**texto salte de linea si llega al final */
        word-wrap: break-word;
    }

    .table-row-post {
        display: flex;
        width: 100%;
        height: 40px;
    }

    .table-data,
    .header__item {
        flex: 1 1 20%;
        text-align: center;
    }

    .header__item {
        text-transform: uppercase;
    }

    .filter__link {
        color: white;
        text-decoration: none;
        position: relative;
        display: inline-block;

    }

    .header {
        margin-top: 120px;
        text-align: center;
    }

    input[type="text"],
    [type="email"] {
        /* padding: 5px 0px; */
        width: 100%;
        height: 50px;
    }

    #experiencia {

        width: 100%;
        height: 50px;
    }



    .beautiful-select {
        width: 100%;
        height: 35px;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 5px 0px;
    }


    select {
        padding: 8px 0px;
    }

    .container {
        width: 100%;
        max-width: 1500px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .red {
        color: red;
        margin-top: 2px;
    }

    .alert-danger {
        padding: 20px;
        background-color: #c0392b;
        color: white;
        margin-top: 100px;
        z-index: -10;

    }

    .own-table-header {
        display: flex;
        width: 100%;
        /**Beautiful styles */
        border: 1px solid #000;

        font-weight: 700;
        font-size: 1.2em;
        padding: 1em;
    }


    /* CSS */
    button {
        align-items: center;
        background-clip: padding-box;
        background-color: #007bff;
        border: 1px solid transparent;
        border-radius: .25rem;
        box-shadow: rgba(0, 0, 0, 0.02) 0 1px 3px 0;
        box-sizing: border-box;
        color: #fff;
        cursor: pointer;
        display: inline-flex;
        font-family: system-ui, -apple-system, system-ui, "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 16px;
        font-weight: 600;
        justify-content: center;
        line-height: 1.25;
        margin: 0;
        min-height: 3rem;
        padding: calc(.875rem - 1px) calc(1.5rem - 1px);
        position: relative;
        text-decoration: none;
        transition: all 250ms;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        vertical-align: baseline;
        width: auto;
        /***Centrar horizontalmente */

    }

    button:hover,
    button:focus {
        background-color: #fb8332;
        box-shadow: rgba(0, 0, 0, 0.1) 0 4px 12px;
    }

    button:hover {
        transform: translateY(-1px);
    }

    button:active {
        background-color: #c85000;
        box-shadow: rgba(0, 0, 0, .06) 0 2px 4px;
        transform: translateY(0);
    }

    .button-container {
        display: flex;
        justify-content: center;
        margin-bottom: 50px;
    }
</style>

<h1 class="header">Diario de los muertos</h1>

<?php if (isset($errores['error_server'])) {
    echo '<div class="alert-danger">';
    echo $errores['error_server'];
    echo '</div>';
} ?>


<div class="container">



    <div class="table-content">
        <!----ENVIA A LA MISMA PAGINA-->
        <div class="own-table-header">
            <div class="header__item">Mensaje</div>
            <div class="header__item">Experiencia</div>
            <div class="header__item">Nombre</div>
            <div class="header__item">Correo</div>

        </div>
        <form method="post" class="my-own-flex">
            <div class="table-row">
                <div class="table-data">
                    <input type="text" name="mensaje" id="mensaje" placeholder="Que quieres decirnos?" value="<?php if (isset($_POST['mensaje'])) echo $_POST['mensaje'] ?>">
                    <?php if (isset($errores['mensaje'])) {
                        //DISPARAMOS UNA ALERTA QUE DICE QUE HAY ERRORES EN EL MENSAJE
                        echo '<p class="red">' . $errores['mensaje'] . '</p>';
                    } ?>
                </div>
                <div class="table-data">
                    <select name="experiencia" id="experiencia" class="beautiful-select" value="<?php if (isset($_POST['experiencia']))  echo $_POST['experiencia'] ?>">

                        <option value="Mala">Mala</option>
                        <option value="Meh">MEH</option>
                        <option value="Buena">BUENA</option>
                        <option value="Muy buena">MUY BUENA</option>
                    </select>
                    <?php if (isset($errores['experiencia'])) {
                        //DISPARAMOS UNA ALERTA QUE DICE QUE HAY ERRORES EN LA EXPERIENCIA
                        echo '<p class="red">' . $errores['experiencia'] . '</p>';
                    } ?>
                </div>
                <div class="table-data">
                    <input type="text" name="nombre" id="nombre" placeholder="Tu nombre" value="<?php if (isset($_POST['nombre']))  echo $_POST['nombre'] ?>">
                    <?php if (isset($errores['nombre'])) {
                        //DISPARAMOS UNA ALERTA QUE DICE QUE HAY ERRORES EN LA NOMBRE
                        echo '<p class="red">' . $errores['nombre'] . '</p>';
                    } ?>
                </div>
                <div class="table-data">
                    <input type="text" name="correo" id="correo" placeholder="Tu correo?" value="<?php if (isset($_POST['correo'])) echo $_POST['correo'] ?>">
                    <?php if (isset($errores['correo'])) {
                        //DISPARAMOS UNA ALERTA QUE DICE QUE HAY ERRORES EN EL CORREO
                        echo '<p class="red">' . $errores['correo'] . '</p>';
                    } ?>
                </div>
                <br>
            </div>
            <div class="button-container">
                <button type="submit" class="table-data">Enviar el comentario</button>
            </div>
        </form>





    </div>



    <div class="table">
        <div class="table-header">
            <div class="header__item"><a id="name" class="filter__link" href="#">Mensaje</a></div>
            <div class="header__item"><a id="wins" class="filter__link filter__link--number" href="#">Experiencia</a></div>
            <div class="header__item"><a id="draws" class="filter__link filter__link--number" href="#">Nombre</a></div>
            <div class="header__item"><a id="losses" class="filter__link filter__link--number" href="#">Correo</a></div>
            <div class="header__item"><a id="total" class="filter__link filter__link--number" href="#">Fecha</a></div>
        </div>
        <div class="table-content">
            <?php echo $comentarios_html ?>
        </div>
    </div>
</div>