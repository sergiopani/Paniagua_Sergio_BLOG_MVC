<div id="contentwrapper">
    <?php echo $alert ?>
    <div id="content">

        <div id="leftbod">

            <div class="connect bolder">
                Postea en en el blog! Y guarda tus posts favoritos!</div>

            <div class="leftbar">
                <img src="../imgs/icons/logearse.png" alt="" class="iconwrap fb1" />
                <div class="fb1">
                    <span class="rowtext">Sube fotos y actualizalas</span>
                    <span class="rowtext2 fb1">de tus amigos!</span>
                </div>
            </div>

            <div class="leftbar">
                <img src="../imgs/icons/fortune-teller.png" alt="" class="iconwrap fb1" />
                <div class="fb1">
                    <span class="rowtext">Mira que post nuevos hay</span>
                    <span class="rowtext2 fb1">disfruta de un tiempo </span>
                </div>
            </div>

            <div class="leftbar">
                <img src="../imgs/icons/coffee.png" alt="" class="iconwrap fb1" />
                <div class="fb1">
                    <span class="rowtext">Mira mas</span>
                    <span class="rowtext2 fb1">Mira cuantos usuarios los ven!</span>
                </div>
            </div>


        </div>

        <form action="?register/register" method="post" enctype="multipart/form-data" id="rightbod">
            <div class="signup bolder">Registrate!</div>
            <div class="free bolder">Es gratis y siempre lo va a ser!</div>

            <div class="formbox">
                <input style="width:40%" value="<?php echo $user_form['name'] ?>" name="name" id="username" type="text" class="inputbody in1" placeholder="First name">
                <input style="width:38%" value="<?php echo $user_form['secondname'] ?>" name="secondname" id="secondname" type="text" class="inputbody in1 fr" placeholder="Last name">
                <?php
                echo '<p style="color:red">' . $errores['name'] . '</p>';
                ?>
                <?php
                echo '<p style="color:red">' . $errores['secondname'] . '</p>';
                ?>
            </div>
            <div class="formbox">
                <input type="text" name="email" id="email" class="inputbody in2" placeholder="Email" value="<?php echo $user_form['email'] ?>">
                <?php
                echo '<p style="color:red">' . $errores['email'] . '</p>';
                ?>
            </div>

            <div class="formbox">
                <input type="password" class="inputbody in2" placeholder="New password" name="password" value="<?php echo $user_form['password'] ?>">
                <?php
                echo '<p style="color:red">' . $errores['password'] . '</p>';
                ?>
            </div>
            <div class="formbox" style="margin-bottom:10px">
                <span data-type="selectors">
                    <span>
                        <label for="tipoIdent">Identificación:</label>
                        <select name="tipoIdent" title="tipoIdent" class="selectbody">
                            <option value="DNI" selected>DNI</option>
                            <option value="NIE">NIF</option>
                            <option value="CIF">CIF</option>
                        </select>
                    </span>

            </div>
            <?php
            echo '<p style="color:red">' . $errores['tipoIdent'] . '</p>';
            ?>
            <div class="formbox">
                <input type="text" class="inputbody in2" placeholder="N. dentificacion" name="numeroIdent" value="<?php echo $user_form['numeroIdent'] ?>">
                <?php
                echo '<p style="color:red">' . $errores['numeroIdent'] . '</p>';
                ?>
            </div>
            <div class="formbox" style="margin-bottom:10px">
                <span data-type="selectors">
                    <span>
                        <label for="sexo">Sexo:</label>
                        <select name="sexo" title="sexo" class="selectbody">
                            <option value="H" selected>Hombre</option>
                            <option value="M">Mujer</option>
                            <option value="O">Otro</option>
                        </select>
                    </span>
            </div>
            <?php
            echo '<p style="color:red">' . $errores['sexo'] . '</p>';
            ?>
            <div class="formbox">
                <input type="text" class="inputbody in2" placeholder="Direcion" name="direcion" value="<?php echo $user_form['direcion'] ?>">
                <?php
                echo '<p style="color:red">' . $errores['direcion'] . '</p>';
                ?>
            </div>
            <div class="formbox">
                <input type="text" class="inputbody in2" placeholder="Poblacion" name="poblacion" value="<?php echo $user_form['poblacion'] ?>">
                <?php
                echo '<p style="color:red">' . $errores['poblacion'] . '</p>';
                ?>
            </div>
            <div class="formbox">
                <input type="text" class="inputbody in2" placeholder="Provincia" name="provincia" value="<?php echo $user_form['provincia'] ?>">
                <?php
                echo '<p style="color:red">' . $errores['provincia'] . '</p>';
                ?>
            </div>
            <div class="formbox">
                <input type="text" class="inputbody in2" placeholder="Telefono" name="telefono" value="<?php echo $user_form['telefono'] ?>">
                <?php
                echo '<p style="color:red">' . $errores['telefono'] . '</p>';
                ?>
            </div>
            <div class="formbox">
                <label for="imagen">Imagen del usuario:</label>
                <input type="file" name="imagen" id="imagen"><br><br>
            </div>

            <div class="formbox">
                <div class="agree">
                    By clicking Sign Up, you agree to our <div class="link">Terms</div> and that you have read our <div class="link">Data Use Policy</div>, including our <div class="link">Cookie Use</div>.
                </div>
            </div>

            <button type="submit" class="signbut bolder" name="register">Registrarse</button>

            <div class="formbox">
                <div class="create">
                    <div class="link h">Create a Page</div> for a celebrity, band or business.
                </div>
            </div>
        </form>
    </div>
</div>