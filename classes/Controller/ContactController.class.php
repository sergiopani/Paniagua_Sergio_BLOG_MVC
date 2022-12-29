<?php
class ContactController extends Controller
{
    private $contact;
    public function __construct()
    {
        //Vaciado
    }

    public function show()
    {
        /**
         * Verfificamos los datos del Formulario
         */
        if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["boto"]))) {
            /**
             * PASO 1 ->  SANITIZAMOS Y VALIDAMOS TODO
             */
            $variables_corregidas['username'] = $this->validar_username($this->sanitize($_POST["username"], 1));
            $variables_corregidas['email'] = $this->validar_email($this->sanitize($_POST["email"], 1));
            $variables_corregidas['password'] = $this->validar_password($this->sanitize($_POST["password"], 1));
            $variables_corregidas['genero'] = $this->validar_genero($this->sanitize($_POST["genero"], 1));
            $variables_corregidas['descripcion'] = $this->validar_descripcion($this->sanitize($_POST["descripcion"], 1));

            /**
             * PASO 2 -> Si username email y password no estan definidos
             * o estan vacios, entonces mostramos un mensaje de error
             */
            if (empty($variables_corregidas['username']) || empty($variables_corregidas['email']) || empty($variables_corregidas['password'])) {
                $message = 'No has rellenado todos los campos obligatorios *';
                $message_type = 'alert-danger';
            } else {
                $this->contact = new Contact(
                    $variables_corregidas['username'],
                    $variables_corregidas['email'],
                    $variables_corregidas['password'],
                    $variables_corregidas['genero'],
                    $variables_corregidas['descripcion']
                );

                /**
                 * PASO 3 -> Guardamos los datos en el XML
                 */

                if (ContactModel::create($this->contact)) {

                    $this->contact = null;

                    $message = 'Se ha enviado correctamente la solicitud!';
                    $message_type = 'alert-success';
                }
            }
        }

        $vista = new ContactView($this->contact);

        if (isset($message) && isset($message_type)) {
            $vista->show($message, $message_type);
        } else {
            $vista->show();
        }
    }
}
