<div id="contentwrapper" style="height:680px">
    <?php echo $alert ?>
    <div id="content" style="margin-top:120px">

        <div id="leftbod">

            <div class="connect bolder">
                Postea en en el blog! Y guarda tus posts favoritos!</div>

            <div class="leftbar">
                <img src="imgs/icons/planta.png" alt="" class="iconwrap fb1" />
                <div class="fb1">
                    <span class="rowtext">Sube fotos y actualizalas</span>
                    <span class="rowtext2 fb1">de tus amigos!</span>
                </div>
            </div>

            <div class="leftbar">
                <img src="imgs/icons/planta1.png" alt="" class="iconwrap fb1" />
                <div class="fb1">
                    <span class="rowtext">Mira que post nuevos hay</span>
                    <span class="rowtext2 fb1">disfruta de un tiempo </span>
                </div>
            </div>

            <div class="leftbar">
                <img src="imgs/icons/planta2.png" alt="" class="iconwrap fb1" />
                <div class="fb1">
                    <span class="rowtext">Mira mas</span>
                    <span class="rowtext2 fb1">Mira cuantos usuarios los ven!</span>
                </div>
            </div>


        </div>

        <form action="?login/login" method="post" enctype="multipart/form-data" id="rightbod">
            <div class="signup bolder">Login!</div>
            <div class="free bolder">Ya tienes tu cuenta, Haz Login!</div>


            <div class="formbox">
                <input type="text" name="email" id="email" class="inputbody in2" placeholder="Email" value="<?php echo $actualValues['email'] ?>">
                <?php
                echo '<p style="color:red">' . $errores['email'] . '</p>';
                ?>
            </div>

            <div class="formbox">
                <input type="password" class="inputbody in2" placeholder="New password" name="password" value="<?php echo $actualValues['password'] ?>">
                <?php
                echo '<p style="color:red">' . $errores['password'] . '</p>';
                ?>
            </div>

            <div class="formbox">
                <div class="agree">
                    By clicking Sign Up, you agree to our <div class="link">Terms</div> and that you have read our <div class="link">Data Use Policy</div>, including our <div class="link">Cookie Use</div>.
                </div>
            </div>

            <button type="submit" class="signbut bolder" name="login">Login</button>

            <div class="formbox">
                <div class="create">
                    <div class="link h">Create a Page</div> for a celebrity, band or business.
                </div>
            </div>
        </form>
    </div>
</div>