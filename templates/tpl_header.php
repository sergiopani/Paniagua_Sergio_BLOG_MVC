<div class="home-page">
    <header>
        <!--Lanzamos una alerta con el mensaje hemos guardado en $_SESION -->
        <?php if (isset($_SESSION['message']) && isset($_SESSION['message_type'])) {
            echo "<div class=" . $_SESSION['message_type'] . ">"  . $_SESSION['message'] . "</div>";
            //Limpiamos toda la array de la sesion para que no se muestre el mensaje 2 veces al cargar				
            $_SESSION = array();
        }
        ?>
        <nav id="menu">
            <ul>
                <div class="custom-header">
                    <div class="logo">
                        <figure>
                            <a href="../index.php">
                                <img src="../imgs/random-images/1.png" alt="logo" style="width: 400px;" />
                            </a>
                        </figure>

                    </div>
                    <div class="header-items">
                        <ul>
                            <li><a href="../index.php" class="current"><?php echo $traducciones["header_blog"]?></a></li>
                            <li><a href="../pages/registro.php"><?php echo $traducciones["header_about"]?></a></li>
                            <li><a href="../pages/formulario.php"><?php echo $traducciones["register"]?></a></li>
                        </ul>

                    </div>
                    <div class="idiomas">
                        <a href="?language/set/es"><img class="country" src="../imgs/random-images/es.png" /></a>
                        <a href="?language/set/en"><img class="country" src="../imgs/random-images/en.png" /></a>
                        <a href="?language/set/al"><img class="country" src="../imgs/random-images/al.png" /></a>
                        <a href="?language/set/fr"><img class="country" src="../imgs/random-images/fr.png" /></a>
                        <a href="?language/set/xn"><img class="country" src="../imgs/random-images/xn.png" /></a>
                    </div>
                </div>
                <li class="socials">
                    <ul>
                        <li>
                            <a href="https://www.facebook.com/charitha.goonewardena" target="_blank"><i class="fab fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/in/charitha-g/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                    </ul>
                </li>
                <li class="icon" href="javascript:void(0);" onclick="myFunction()">
                    <i class="fas fa-bars"></i>
                </li>
            </ul>
        </nav>
    </header>

