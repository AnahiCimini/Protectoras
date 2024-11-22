<?php
require_once PROJECT_ROOT . '/src/models/Protectora.php';

class ProtectoraController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function register() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crea una instancia de Protectora y asigna los datos del formulario
            $protectora = new Protectora($this->conn);
            $protectora->nombre_protectora = $_POST['nombreProtectora'];
            $protectora->direccion = $_POST['direccion'];
            $protectora->telefono = $_POST['telefono'];
            $protectora->email = $_POST['email'];
            $protectora->id_provincia = $_POST['provincias'];
            $protectora->poblacion = $_POST['poblacion'];
            $protectora->web = $_POST['web'];
            //$protectora->logo = $_POST['logo'];
            $protectora->email_visible = $_POST['emailVisibility'];
            $protectora->password_user = $_POST['password'];


            //El nombre de la protectora ya existe: mostrar error
            if ($protectora->nombreExists($protectora->nombre_protectora)) {
                echo "<script>
                    alert('El nombre de la protectora ya existe. Por favor, elige otro.');
                    window.history.back();
                </script>";
                exit;
            }


            // Llama al método para registrar la protectora
            if ($protectora->registerProtectora()) {
                echo "<script>
                        var redirectUrl = '" . dirname($_SERVER['PHP_SELF']) . "/index.php?case=home';
                        alert('Registro exitoso. Serás redirigido a la página principal.');
                        window.location.href = redirectUrl;
                </script>";
                require_once PROJECT_ROOT . '/src/controllers/LoginController.php';
                $loginController = new LoginController($this->conn);
                $loginController->login();
            } else {
                echo "Error al registrar la protectora.";
            }
        }
        // Pasar los datos a la vista
        require_once PROJECT_ROOT . '/src/views/registroView.php';
    }
}
?>
