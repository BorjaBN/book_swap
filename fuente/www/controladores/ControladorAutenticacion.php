<?php
    /**
     * Controlador Autenticación
     *      Responsabilidad:
     *      - Recibir los datos de la autenticación
     *      - Aplicar las reglas de negocio
     *      - Navegación entre vistas
     */
class ControladorAutenticacion{
    private $config;

    public function __construct($config){
        $this->config = $config;
    }


     /**
     * Muestra la vista de login.
     *
     * @param string|null $mensaje Mensaje opcional que se mostrará en la vista (ej. error o aviso).
     * @return void
     */
    public function verLogin($mensaje = null){ 

        $vista = new VerLogin($this->config);
        $vista->mostrar($mensaje);
    }


    /**
     * Procesa la autenticación del usuario.
     *
     * - Obtiene los datos enviados por POST (`nombre` y `clave`).
     * - Autentica contra el modelo Usuario.
     * - Si es válido, guarda el ID en sesión y redirige al menú.
     * - Si es inválido, muestra nuevamente la vista de login con mensaje de error.
     *
     * @return void
     *
     * @throws Throwable Captura cualquier excepción durante el proceso de autenticación.
     */
    public function login(){
        try{
 
            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
            $clave  = isset($_POST['clave']) ? trim($_POST['clave']) : '';
           
            $usuario = new Usuario($nombre, $clave);
            $id = $usuario->autenticar();

            if ($id !== null) {
                $_SESSION['usuario_id'] = $id;

            
                $controlador = new ControladorMenu($this->config);
                $controlador->verMenu();

            } else {

                $mensaje = "Credenciales incorrectas.";
                $this->verLogin($mensaje);
                return;

            }

        } catch (Throwable $excepcion){

           http_response_code(500);

            if ($this->config['debug']){
                
                echo "Error en controladorAutenticacion.php:".$excepcion;
            }
        }
    }

    /**
     * Cierra la sesión del usuario.
     *
     * - Limpia la variable global $_SESSION.
     * - Destruye la sesión activa.
     * - Redirige a la vista de login mostrando mensaje de cierre de sesión.
     *
     * @return void
     */
    public function logout(){

        $_SESSION = [];

        session_destroy();

        $mensaje = "Ha cerrado la sesión.";
        $this->verLogin($mensaje);
    }
}
