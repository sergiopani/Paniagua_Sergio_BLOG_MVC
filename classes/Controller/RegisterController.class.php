<?php
class RegisterController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    public function show()
    {
        /**
         * Muestra el formulario de registro
         */
        $view = new RegisterView();
        $view->show();
    }


    public function register()
    {

        /**
         * A traves de lo que nos viene por post del formulario de registro
         * creamos un objeto usuario y lo guardamos en la base de datos
         */

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
            //             `id` int NOT NULL, YES
            //   `email` varchar(40) NOT NULL,YES
            //   `password` varchar(60) NOT NULL, YES
            //   `tipusIdent` varchar(10) NOT NULL,YES
            //   `numeroIdent` varchar(15) NOT NULL,YES
            //   `nom` varchar(30) NOT NULL,YES
            //   `cognoms` varchar(30) NOT NULL,YES
            //   `sexe` varchar(4) NOT NULL,YES
            //   `naixement` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL, !NO
            //   `adreca` varchar(100) DEFAULT NULL, !NO
            //   `codiPostal` varchar(5) DEFAULT NULL,!NO
            //   `poblacio` varchar(40) DEFAULT NULL,YES
            //   `provincia` varchar(40) DEFAULT NULL,YES
            //   `telefon` varchar(9) DEFAULT NULL,YES
            //   `imatge` varchar(100) DEFAULT NULL,NO
            //   `status` int NOT NULL DEFAULT '0' COMMENT ' 0: pendent 1:confirmat 2:administradors',
            //   `navegador` varchar(50) NOT NULL,
            //   `plataforma` varchar(50) NOT NULL,
            //   `dataCreacio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            //   `dataDarrerAcces` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
            /**
             * PASO 1 -> Sanitizamos todas las variables
             */
            $user_form['name'] = $this->sanitize_values($_POST['name'], 'text');
            $user_form['secondname'] = $this->sanitize_values($_POST['secondname'], 'text');
            $user_form['email'] = $this->sanitize_values($_POST['email'], 'email');
            $user_form['password'] = $this->sanitize_values($_POST['password'], 'password');
            $user_form['sexo'] = $this->sanitize_values($_POST['sexo']);
            $user_form['tipoIdent'] = $this->sanitize_values($_POST['tipoIdent'], 'identificacion');
            $user_form['numeroIdent'] = $this->sanitize_values($_POST['numeroIdent'], 'identificacion');
            $user_form['nacimiento'] = $this->sanitize_values($_POST['nacimiento'], 'identificacion');
            $user_form['direcion'] = $this->sanitize_values($_POST['direcion'], 'text');
            $user_form['cp'] = $this->sanitize_values($_POST['cp'], 'int');
            $user_form['poblacion'] = $this->sanitize_values($_POST['poblacion'], 'text');
            $user_form['provincia'] = $this->sanitize_values($_POST['provincia'], 'text');
            $user_form['telefono'] = $this->sanitize_values($_POST['telefono'], 'int');
            $user_form['imagen'] = $this->sanitize_values($_FILES['imagen']['name']);

            /** 
             * PASO 2 -> Validamos todos los campos
             */
            foreach ($user_form as $key => $value) {
                if (empty($value)) {
                    $errores[$key] = "Este campo no puede estar vacio";
                }
            }

            if (strlen($user_form['nom']) > 30) {
                $errores['nom'] = 'El nombre no puede tener más de 30 caracteres';
            }

            if (strlen($user_form['direcion']) > 100) {
                $errores['direcion'] = 'La dirección no puede tener más de 100 caracteres';
            }

            if (strlen($user_form['poblacion']) > 40) {
                $errores['poblacion'] = 'La población no puede tener más de 40 caracteres';
            }

            if (strlen($user_form['provincia']) > 40) {
                $errores['provincia'] = 'La provincia no puede tener más de 40 caracteres';
            }

            if (strlen($user_form['cognoms']) > 30) {
                $errores['cognoms'] = 'Los apellidos no pueden tener más de 30 caracteres';
            }

            if (strlen($user_form['password']) <= 0 && strlen($user_form['password']) >= 60) {
                $errores['password'] = 'El password debe tener al menos 8 caracteres';
            }

            if (!in_array($user_form["tipoIdent"], array('DNI', 'NIE', 'CIF'))) {
                $errores['tipoIdent'] = 'El tipo de identificacion no es valido';
            }

            if (!preg_match('/^[0-9A-Z]{8,15}$/', strtoupper($user_form['numeroIdent']) || strlen($user_form['numeroIdent'])) > 15) {
                $errores['numeroIdent'] = 'El número de identificación no es válido';
            }

            if (!in_array($user_form['sexo'], array('H', 'M', 'O'))) {
                $errores['sexo'] =  'El sexo no es válido';
            }

            if (!preg_match('/^[0-9]{9}$/', $user_form['telefono'])) {
                $errores['telefono'] = 'El número de teléfono no es válido';
            }

            if (!filter_var($user_form['email'], FILTER_VALIDATE_EMAIL) || strlen($user_form['email']) > 40) {
                $errores["email"] = "La direcion de correo no es valida!";
            }

            if (in_array("", $user_form)) {
                $errores["empty"] = "Necesitas rellanar todos los campos!";
                $message = "Necesitas rellanar todos los campos!";
                $message_type = "danger";
            }

            if (isset($user_form['nacimiento'])) {
                $user_form['nacimiento'] = date("Y-m-d", strtotime($user_form['nacimiento']));
            }

            /**
             * Tratamos la imagen
             */
            $result_image = $this->save_image($_FILES['imagen']);

            if ($result_image[0]) {
                $user_form['imagen'] = $result_image[1];
            } else {
                $errores['imagen'] = $result_image[1];
            }




            /**
             * PASO 3 -> Si hay errores
             * mostramos la vista de registro con los errores
             */
            if (isset($errores)) {

                $view = new RegisterView();
                //Si $message y $message_type no estan definidos
                //no se mostraran en la vista

                if (!isset($message) && !isset($message_type)) {
                    $message = null;
                    $message_type = null;
                }

                $view->show($user_form, $errores, $message, $message_type);
            } else {


                /**
                 * PASO 4 -> Todos los datos han sido correctos y validados!!
                 * Ahora toca instanciar el objeto de negocio del modelo
                 * para poder guardar los datos
                 */
                $blog_user = new BlogUser(
                    $user_form['email'],
                    $user_form['password'],
                    '0', //De momento en status de pendiente
                );

                //!TODO añadir todos los atibutos que le faltan al BlogUser
                //añadir el valor a todos estos atributos
                $blog_user->setNom($user_form['name']);
                $blog_user->setCognoms($user_form['secondname']);
                $blog_user->setSexe($user_form['sexo']);
                $blog_user->setTipusIdent($user_form['tipoIdent']);
                $blog_user->setNumeroIdent($user_form['numeroIdent']);
                $blog_user->setPoblacio($user_form['poblacion']);
                $blog_user->setProvincia($user_form['provincia']);
                $blog_user->setTelefon($user_form['telefono']);
                $blog_user->setNaixement($user_form['nacimiento']);
                $blog_user->setAdreca($user_form['direcion']);
                $blog_user->setCodiPostal($user_form['cp']);
                $blog_user->setImatge($user_form['imagen']);

                $user_agent = $_SERVER['HTTP_USER_AGENT'];


                $navegador = substr($user_agent, 0, strpos($user_agent, ';'));

                $plataforma = substr($user_agent, strpos($user_agent, ';') + 1, strpos($user_agent, ')'));

                $blog_user->setNavegador($navegador);
                //La plataforma Si esta en windows o en mac o en linux
                $blog_user->setPlataforma($plataforma);
                //La fehca de creacion
                $blog_user->setDataCreacio(date('Y-m-d H:i:s'));
                //La fecha de ultimo acceso
                $blog_user->setDataDarrerAcces(date('Y-m-d H:i:s'));




                /** 
                 * Creamos la conexion con el usuario
                 * que tiene permisos para realizar selects
                 * como la conexion se va a cerrar
                 */


                $host = $this->env['DB_HOST'];
                $dbname = $this->env['DB_DATABASE'];
                $username = $this->env['USR_GENERIC'];
                $password = $this->env['USR_PASSWORD'];
                BlogUserModel::create_connection($host, $dbname, $username, $password);

                /**
                 * PASO 4 -> Primero comprobamos si el email ya existe
                 * sino no vamos a registrarlo, y lanzaremos una alerta de error
                 * para que el usuario prueve con otro email en la vista de registro                 * 
                 */
                list($success, $error) = BlogUserModel::emailExists($user_form['email']);
                if (!$success) {
                    $message = "Ya existe el correo $error";
                    $message_type = "danger";
                    $view = new RegisterView();
                    $view->show($user_form, null, $message, $message_type);
                    /**
                     * No queremos que continue mas 
                     */
                    return;
                }

                /**
                 * PASO 5 -> No pueden haber dos numeros de identificacion iguales
                 * eso significaria que ya existe alguien con la misma cuenta
                 * por lo tanto tampoco dejamos insertar
                 * 
                 */
                BlogUserModel::create_connection($host, $dbname, $username, $password);
                list($success, $error) = BlogUserModel::numeroIdentExists($user_form['numeroIdent']);

                if (!$success) {
                    $message = "Ya existe un usuario con el mismo numero de identifiacion: $error";
                    $message_type = "danger";
                    $view = new RegisterView();
                    $view->show($user_form, null, $message, $message_type);
                    /**
                     * No queremos que continue mas 
                     */
                    return;
                }


                /**
                 * PASO 6 -> Como el usuario no existe en la base de datos
                 * ahora si que lo podemos insertar
                 */
                BlogUserModel::create_connection($host, $dbname, $username, $password);
                list($success, $error) = BlogUserModel::insert($blog_user);


                /**
                 * PASO 7 -> Una vez insertado el usuario
                 * Podemos enviarlo a la pagina de Login 
                 * despues de la que haga login correctamente ya estara
                 * identificado en la pagina
                 */
                if ($success) {
                    $message = "Usuario registrado correctamente!";
                    $message_type = "success";

                    $view = new LoginView();
                    $view->show(null, null, $message, $message_type);
                } else {
                    $message = "Error al registrar el usuario: $error";
                    $message_type = "danger";
                    $view = new RegisterView();
                    $view->show($user_form, null, $message, $message_type);
                }
            }
        }
    }
}
