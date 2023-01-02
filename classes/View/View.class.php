<?php
class View
{
    protected $lang;

    public function __construct()
    {
        if (isset($_COOKIE["lang"])) {
            $this->lang = $_COOKIE["lang"];
        } else {
            $this->lang = "es";
        }
    }

    public function getFitxer()
    {
        $file = "languages/{$this->lang}.php";
        if (file_exists($file)) {
            return $file;
        } else {
            throw new Exception("No existeix el fitxer de traduccicons $file");
        }
    }

    function htmlGenerateContactos($contactos)
    {
        /**
         * PASO 1 -> ESTO ES LO QUE QUIERO GENERAR
         */
        // <div class="table-data">EJEMPLO</div>
        $resultado = '';
        /**
         * PASO 2 -> GENERAR EL HTML como tantos contactos como tenga el array
         */
        for ($i = 0; $i < count($contactos); $i++) {
            $resultado .= '<div class="own-table-row">' .
                '<div class="table-data">' .
                $contactos[$i]->getMensaje() . '</div>' .
                '<div class="table-data">' .
                $contactos[$i]->getExperiencia() . '</div>' .
                '<div class="table-data">' .
                $contactos[$i]->getNombre() . '</div>' .
                '<div class="table-data">' .
                $contactos[$i]->getEmail() . '</div>' .
                '<div class="table-data">' . $contactos[$i]->getFecha() . '</div>' .
                '</div>';
        }

        return $resultado;
    }
    public function getAlert($message, $message_type)
    {
        if ($message) {
            return '<div class="alert alert-' . $message_type . '" role="alert">' . $message . '</div>';
        } else {
            return '';
        }
    }

    public function getErrors($errores)
    {
        /**
         * La primera vez que entramos al formulario
         * no hay errores, por lo que no hay que mostrar nada
         */
        $errors_to_html['name'] = isset($errores['name']) ? $errores['name'] : '';
        $errors_to_html['secondname'] = isset($errores['secondname']) ? $errores['secondname'] : '';

        $errors_to_html['email'] = isset($errores['email']) ? $errores['email'] : '';
        $errors_to_html['email-repeated'] = isset($errores['email-repeated']) ? $errores['email-repeated'] : '';
        $errors_to_html['password'] = isset($errores['password']) ? $errores['password'] : '';
        $errors_to_html['numeroIdent'] = isset($errores['numeroIdent']) ? $errores['numeroIdent'] : '';
        $errors_to_html['tipoIdent'] = isset($errores['tipoIdent']) ? $errores['tipoIdent'] : '';
        $errors_to_html['sexo'] = isset($errores['sexo']) ? $errores['sexo'] : '';
        $errors_to_html['direcion'] = isset($errores['direcion']) ? $errores['direcion'] : '';
        $errors_to_html['telefono'] = isset($errores['telefono']) ? $errores['telefono'] : '';
        $errors_to_html['poblacion'] = isset($errores['poblacion']) ? $errores['poblacion'] : '';
        $errors_to_html['provincia'] = isset($errores['provincia']) ? $errores['provincia'] : '';
        //añadir todos los valores de form_values a errores
        // $errors_to_html = array_merge($errores, $form_values);


        return $errors_to_html;
    }

    public function getValues($values)
    {
        $values_to_html['name'] = isset($values['name']) ? $values['name'] : '';
        $values_to_html['secondname'] = isset($values['secondname']) ? $values['secondname'] : '';

        $values_to_html['email'] = isset($values['email']) ? $values['email'] : '';
        $values_to_html['password'] = isset($values['password']) ? $values['password'] : '';
        $values_to_html['numeroIdent'] = isset($values['numeroIdent']) ? $values['numeroIdent'] : '';
        $values_to_html['tipoIdent'] = isset($values['tipoIdent']) ? $values['tipoIdent'] : '';
        $values_to_html['sexo'] = isset($values['sexo']) ? $values['sexo'] : '';
        $values_to_html['direcion'] = isset($values['direcion']) ? $values['direcion'] : '';
        $values_to_html['poblacion'] = isset($values['poblacion']) ? $values['poblacion'] : '';
        $values_to_html['provincia'] = isset($values['provincia']) ? $values['provincia'] : '';
        $values_to_html['telefono'] = isset($values['telefono']) ? $values['telefono'] : '';
        //añadir todos los valores de form_values a errores
        // $values_to_html = array_merge($values, $form_values);
        return $values_to_html;
    }
}
