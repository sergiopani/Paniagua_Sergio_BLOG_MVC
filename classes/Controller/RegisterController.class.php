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
            /**
             * PASO 1 -> Sanitizamos todas las variables
             */
            $user_form['name'] = $this->sanitize($_POST['name'], 4);
            $user_form['secondname'] = $this->sanitize($_POST['secondname'], 4);
            $user_form['email'] = $this->sanitize($_POST['email'], 1);
            $user_form['password'] = $this->sanitize($_POST['password'], 2);
            $user_form['sexo'] = $this->sanitize($_POST['sexo'], 4);
            $user_form['tipoIdent'] = $this->sanitize($_POST['tipoIdent'], 4);
            $user_form['numeroIdent'] = $this->sanitize($_POST['numeroIdent'], 4);
            $user_form['direcion'] = $this->sanitize($_POST['direcion'], 4);
            $user_form['poblacion'] = $this->sanitize($_POST['poblacion'], 4);
            $user_form['provincia'] = $this->sanitize($_POST['provincia'], 4);
            $user_form['telefono'] = $this->sanitize($_POST['telefono'], 4);

            /** 
             * PASO 2 -> Validamos todos los campos
             */
            foreach ($user_form as $key => $value) {
                if (empty($value)) {
                    $errores[$key] = "Este campo no puede estar vacio";
                }
            }

            if (strlen($user_form['password']) < 8 && strlen($user_form['password']) > 50) {
                $errores['password'] = 'El password debe tener al menos 8 caracteres';
            }

            if (!in_array($user_form["tipoIdent"], array('dni', 'nie', 'cif'))) {
                $errores['tipoIdent'] = 'El tipo de identificacion no es valido';
            }

            if (!preg_match('/^[0-9A-Z]{8,15}$/', strtoupper($user_form['numeroIdent']))) {
                $errores['numeroIdent'] = 'El número de identificación no es válido';
            }

            if (!in_array($user_form['sexo'], array('h', 'm', 'o'))) {
                $errores['sexo'] =  'El sexo no es válido';
            }

            if (!preg_match('/^[0-9]{9}$/', $user_form['telefono'])) {
                $errores['telefono'] = 'El número de teléfono no es válido';
            }

            if (!filter_var($user_form['email'], FILTER_VALIDATE_EMAIL)) {
                $errores["email"] = "La direcion de correo no es valida!";
            }

            if (in_array("", $user_form)) {
                $errores["empty"] = "Necesitas rellanar todos los campos!";
                $message = "Necesitas rellanar todos los campos!";
                $message_type = "danger";
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
                $blog_user->setNaixement(null);
                $blog_user->setAdreca(null);
                $blog_user->setCodiPostal(null);
                $blog_user->setImatge(null);
                //el navegador en el que se encuentra
                $blog_user->setNavegador($_SERVER['HTTP_USER_AGENT']);
                //La plataforma en la que se encuentra
                $blog_user->setPlataforma($_SERVER['HTTP_USER_AGENT']);
                //La fehca de creacion
                $blog_user->setDataCreacio(date('Y-m-d H:i:s'));
                //La fecha de ultimo acceso
                $blog_user->setDataDarrerAcces(date('Y-m-d H:i:s'));




                //Creamos la conexion

                $host = 'localhost';
                $dbname = 'web';
                $username = 'root';
                $password = '';
                BlogUserModel::create_connection($host, $dbname, $username, $password);

                /**
                 * PASO 4 -> Si el correo ya existe
                 * no lo podemos registrar por tanto lanzamos una alerta en la view
                 */
                if (BlogUserModel::emailExists($user_form['email'])) {
                    $message = "El correo ya existe!";
                    $message_type = "danger";
                    $view = new RegisterView();
                    $view->show($user_form, null, $message, $message_type);
                    return;
                }

                /**
                 * PASO 5 -> Si el usuario ya existe
                 * no lo podemos registrar por tanto lanzamos una alerta en la view
                 */
                // if (BlogUserModel::usernameExists($user_form['username'])) {
                //     $message = "El usuario ya existe!";
                //     $message_type = "danger";
                //     $view = new RegisterView();
                //     $view->show($user_form, null, $message, $message_type);
                //     return;
                // }


                /**
                 * PASO 6 -> Como el usuario no existe en la base de datos
                 * ahora si que lo podemos insertar
                 */
                BlogUserModel::insert($blog_user);
            }
        }
    }
}
