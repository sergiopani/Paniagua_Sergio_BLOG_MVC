<?php
class CommentAdminController extends Controller
{


    public function __construct()
    {
        parent::__construct();
    }



    public function show()
    {
        //Vamos guardar el comentario en el xml
        //y despues lo vamos a mostrar en la pantalla        

        $errores = array();

        //PASO 1 -> SANITIZAMOS LOS DATOS

        //MENSAJE
        if (isset($_POST['mensaje'])) {
            //PASO 1.1 -> Sanitizar el mensaje
            $mensaje = $this->sanitize($_POST['mensaje'], 1);
            //PASO 1.2 -> Validar el mensaje que ya hemos sanitizado
            $errores['mensaje'] = $this->validarMensaje($mensaje);
        }

        //EXPERIENCIA
        if (isset($_POST['experiencia'])) {
            //PASSO 1.1 -> Sanitizar la experiencia
            $experiencia = $this->sanitize($_POST['experiencia'], 1);
            //PASO 1.2 -> Validar la experiencia que ya hemos sanitizado
            $errores['experiencia'] = $this->validarExperiencia($experiencia);
        }

        //NOMBRE
        if (isset($_POST['nombre'])) {
            $nombre = $this->sanitize($_POST['nombre'], 1);
            $errores['nombre'] = $this->validarNombre($nombre);
        }

        //CORREO
        if (isset($_POST['correo'])) {
            $correo = $this->sanitize($_POST['correo']);
            $errores['correo'] = $this->validarCorreo($correo);
        }

        $errores = array_filter($errores);


        //PASO 4 -> Leemos los contactos del xml
        try {
            $contactosArray = ComentarioModel::read();
        } catch (Exception $e) {
            $errores['error_server'] = $e->getMessage();
        }


        //PASO 5 -> Actualizamos la tabla de contactos ABAJO EN EL HTML

        if (count($errores) == 0 && $_SERVER['REQUEST_METHOD'] == 'POST') {

            $contacto = new Comentario($nombre, $correo, $mensaje, null, $experiencia);
            //PASO 3.2 -> Guardar el contacto en el fichero xml
            try {
                ComentarioModel::create($contacto);
            } catch (Exception $e) {
                $errores['error_server'] = $e->getMessage();
            }

            $contactosArray = ComentarioModel::read();
        }



        $vista = new CommentAdminView();
        $vista->show($contactosArray, $errores);
    }

    public function delete()
    {
        $errores = array();

        if (isset($_GET['id'])) {
            /**  
             * Ojo primero lo sanitizamos!!! Que la ruta sigue siendo una cosa que viene de internet
             */
            $id = $this->sanitize($_GET['id'], 4);
            try {
                ComentarioModel::delete($id);
            } catch (Exception $e) {
                $errores['error_server'] = $e->getMessage();
            }
        }

        $contactosArray = ComentarioModel::read();

        $vista = new CommentAdminView();
        $vista->show($contactosArray, $errores);
    }
}
