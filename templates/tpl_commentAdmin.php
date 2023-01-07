<style>
    .container {
        width: 100%;
        max-width: 1500px;
        margin: 0 auto;
        padding: 0 20px;
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
        <form method="post" class="my-own-flex" action="?commentAdmin/show">
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