<section class="container">
    <section class="recent-posts">
        <!--Lanzamos una alerta con el mensaje hemos guardado en $_SESION -->
        <?php if (isset($_SESSION['message']) && isset($_SESSION['message_type'])) {
            echo "<div class=" . $_SESSION['message_type'] . ">"  . $_SESSION['message'] . "</div>";
        }
        ?>
        <h1 style="color:black"><?php echo $traducciones["posts_header"] ?></h1>
        <article>
            <figure style="display:flex;flex-direction:column; justify-content: center;">
                <img src="imgs/random-images/woman.png" alt="blog-image" style="width:400px;    margin-left: 46px;" />
                <figcaption style="width:500px;"><?php echo $traducciones["imagen_descripcion6"] ?></figcaption>
            </figure>
            <section class=" content" style="width:800px;">
                <h2 class="title"><?php echo $traducciones["titulo6"] ?></h2>
                <h3 class="sub-title">
                    <?php echo $traducciones["subtitulo6"] ?>
                </h3>
                <p class="summary">
                    <?php echo $traducciones["parrafo6"] ?>
                </p>
                <a href="?register/show" class="btn">
                    <?php echo $traducciones["boton6"] ?> <i class="fas fa-angle-right"></i>
                </a>
            </section>
        </article>
        <article>
            <figure>
                <img src="imgs/random-images/loginImage2.jpg" alt="blog-image" style="width:500px;" />
                <figcaption style="width:500px;"><?php echo $traducciones["imagen_descripcion5"] ?></figcaption>
            </figure>
            <section class=" content" style="width:800px;">
                <h2 class="title"><?php echo $traducciones["titulo5"] ?></h2>
                <h3 class="sub-title">
                    <?php echo $traducciones["subtitulo5"] ?>
                </h3>
                <p class="summary">
                    <?php echo $traducciones["parrafo5"] ?>
                </p>
                <a href="?register/show" class="btn">
                    <?php echo $traducciones["boton5"] ?> <i class="fas fa-angle-right"></i>
                </a>
            </section>
        </article>
        <article>
            <figure>
                <img src="imgs/random-images/GuessBook2.jpg" alt="blog-image" style="width:500px;" />
                <figcaption style="width:500px;"><?php echo $traducciones["imagen_descripcion4"] ?></figcaption>
            </figure>
            <section class=" content" style="width:800px;">
                <h2 class="title"><?php echo $traducciones["titulo4"] ?></h2>
                <h3 class="sub-title">
                    <?php echo $traducciones["subtitulo4"] ?>
                </h3>
                <p class="summary">
                    <?php echo $traducciones["parrafo4"] ?>
                </p>
                <a href="?book/show" class="btn">
                    <?php echo $traducciones["boton4"] ?> <i class="fas fa-angle-right"></i>
                </a>
            </section>
        </article>
        <article>
            <figure>
                <img src="imgs/random-images/usuario.jpg" alt="blog-image" style="width:500px;" />
                <figcaption style="width:500px;"><?php echo $traducciones["imagen_descripcion3"] ?></figcaption>
            </figure>
            <section class=" content" style="width:800px;">
                <h2 class="title"><?php echo $traducciones["titulo3"] ?></h2>
                <h3 class="sub-title">
                    <?php echo $traducciones["subtitulo3"] ?>
                </h3>
                <p class="summary">
                    <?php echo $traducciones["parrafo3"] ?>
                </p>
                <a href="?user/register" class="btn">
                    <?php echo $traducciones["boton3"] ?> <i class="fas fa-angle-right"></i>
                </a>
            </section>
        </article>
        <article>
            <figure>
                <img src="imgs/random-images/contacta2.jpg" alt="blog-image" style="width:500px;" />
                <figcaption style="width:500px;"><?php echo $traducciones["imagen_descripcion2"] ?></figcaption>
            </figure>
            <section class=" content" style="width:800px;">
                <h2 class="title"><?php echo $traducciones["titulo2"] ?></h2>
                <h3 class="sub-title">
                    <?php echo $traducciones["subtitulo2"] ?>
                </h3>
                <p class="summary">
                    <?php echo $traducciones["parrafo2"] ?>
                </p>
                <a href="?contact/show" class="btn">
                    <?php echo $traducciones["boton2"] ?> <i class="fas fa-angle-right"></i>
                </a>
            </section>
        </article>

        <article>
            <figure>
                <img src="assets/dummy/WallStreet.jpeg" alt="blog-image" />
                <figcaption><?php echo $traducciones["imagen_descripcion"] ?></figcaption>
            </figure>
            <section class="content">
                <h2 class="title"><?php echo $traducciones["titulo"] ?></h2>
                <h3 class="sub-title">
                    <?php echo $traducciones["subtitulo"] ?>
                </h3>
                <p class="summary">
                    <?php echo $traducciones["parrafo"] ?>
                </p>
                <a href="?cotis/show" class="btn">
                    <?php echo $traducciones["boton"] ?> <i class="fas fa-angle-right"></i>
                </a>
            </section>
        </article>


        <section class="more-blogs">
            <a class="btn" href="#"><?php echo $traducciones["boton_cargar"] ?><i class="fas fa-chevron-down"></i>
            </a>
        </section>
    </section>