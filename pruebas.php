<?php

ini_set('display_errors', 0);

/**
 * PASO 1 -> 0 -> La cookie se borra al reiniciar el navegador
 */
session_set_cookie_params(0);
/**
 * PASO 2 -> Iniciamos la sesion
 */
session_start();




/**
 * PASO 3 -> Funcion autoloader para cargar las clases de forma automatica
 */
function my_autoloader($class)
{
    $carpetas = array("Controller", "Model", "View");

    foreach ($carpetas as $carpeta) {
        if (file_exists("classes/$carpeta/$class.class.php")) {
            include "classes/$carpeta/$class.class.php";
            return;
        }
    }
    throw new Exception("Nose ha podido cargar la clase: $class");
}


spl_autoload_register("my_autoloader");

//Prueba del read
$prueba = new IndexModel();
echo "<pre>";

print_r($prueba->readIndex());
echo "</pre>";

//Prueba de eliminar el del indice
$to_delete = new Index();
$to_delete->indice = 'aex';
$prueba->deleteIndex($to_delete);


/**
 * PASO 4 -> Cargamos el front controller si se produce alguna excepcion
 * lanzamos un error
 */
// try {

//     $app = new FrontController();
//     $app->dispatch();
    
// } catch (Exception $e) {


//     $obj = new ErrorView($e);
//     $obj->show();
// }
