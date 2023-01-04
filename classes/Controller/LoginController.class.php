<?php

class LoginController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }


    public function show()
    {
        /**
         * Muestra el formulario de login
         */
        $view = new LoginView();

        $view->show();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {

            /**
             * PASO 1 -> Sanitizamos todas las variables que nos vienen por post
             */
            $email = $this->sanitize($_POST['email']);
            $password = $this->sanitize($_POST['password']);

            /**
             * PASO 2 -> Validamos los datos
             */
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores["email"] = "La direcion de correo no es valida!";
            }

            if (strlen($password) <= 0 || strlen($password) >= 60) {
                $errores["password"] = "La contraseña debe tener entre 1 y 60 caracteres!";
            }

            /**
             * PASO 3 -> Si hay errores Lanzamos una alerta en la view
             */
            if (isset($errores)) {
                $view = new LoginView();
                $view->show($errores);
                return;
            }

            /**
             * PASO 4 -> Como no hay errores, ahora debemos de comprobar si el correo
             * existe en la base de datos, para ello utilizo el metodo 
             * emailExists de la clase BlogUserModel
             */
            $env = parse_ini_file('config.env');

            $host = $env['DB_HOST'];
            $dbname = $env['DB_DATABASE'];
            $username = $env['DB_USERNAME'];
            $password = $env['DB_PASSWORD'];

            BlogUserModel::create_connection($host, $dbname, $username, $password);
            list($success, $error) = BlogUserModel::emailExists($email);
            if (!$success) {
                $errores["email"] = "No existe el email: $error";
                $view = new LoginView();
                $view->show($errores, [$email, $password]);
                return;
            }

            /**
             * PASO 5 -> Si el email existe, ahora debemos de comprobar si la contraseña
             * es correcta, para ello utilizo el metodo checkCredentials de la clase
             * BlogUserModel
             */

            BlogUserModel::create_connection($host, $dbname, $username, $password);
            list($success, $error) = BlogUserModel::checkCredentials($email, $password);

            if (!$success) {
                $errores["password"] = "La contraseña no es correcta: $error";
                $view = new LoginView();
                $view->show($errores, [$email, $password]);
                return;
            }

            /**
             * PASO 6 -> Si todo ha ido bien, entonces debemos de crear una sesion
             * para el usuario, para ello utilizo el metodo createSession de la clase
             * BlogUserModel, este metodo tambien redediciona
             * a la pagina principal
             */

            BlogUserModel::createSession($email);

            /**
             * PASO 7 -> Redirigimos a la pagina principal
             */
            $home_view = new HomeView();
            $home_view->show();
        }
    }
}
