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
            $resultado .=  '<div class="own-table-row">' .
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
}
