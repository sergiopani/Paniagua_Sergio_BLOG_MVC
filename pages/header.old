<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sergio Paniagua BLOG</title>
    <link rel="stylesheet" href="../styles/pages/home.css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" />
</head>

<body>
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
                                <li><a href="../index.php" class="current">Home</a></li>
                                <li><a href="../pages/registro.php">Registrarse</a></li>
                                <li><a href="../pages/formulario.php">Contactanos</a></li>
                            </ul>

                        </div>
                        <div class="idiomas">
                            <a href="index.php?lang=es"><img class="country" src="../imgs/random-images/es.png" /></a>
                            <a href="index.php?lang=en"><img class="country" src="../imgs/random-images/en.png" /></a>
                            <a href="index.php?lang=al"><img class="country" src="../imgs/random-images/al.png" /></a>
                            <a href="index.php?lang=fr"><img class="country" src="../imgs/random-images/fr.png" /></a>
                            <a href="index.php?lang=xn"><img class="country" src="../imgs/random-images/xn.png" /></a>
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

    </div>
</body>

</html>