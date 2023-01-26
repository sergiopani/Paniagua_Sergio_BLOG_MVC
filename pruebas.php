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


//Prueba de eliminar el del indice
// $to_delete = new Index();
// $to_delete->indice = 'aex';
// $prueba->delete($to_delete);

$prueba = new IndexModel();

//preueba del update
$to_update = new Index();
$to_update->indice = 'atx';
$to_update->descripcio = 'Accion de la empresa Explotaciones Mineras';
$prueba->update($to_update);


//prueba del insert
$to_insert = new Index();
$to_insert->indice = 'aex';
$to_insert->descripcio = 'Hola me llamo Sergio';
$prueba->create($to_insert);

//Prueba del read
echo "<pre>";

print_r($prueba->read());
echo "</pre>";
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
