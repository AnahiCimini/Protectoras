<?php
require_once PROJECT_ROOT . '/config/config.php';
require_once PROJECT_ROOT . '/src/models/Provincias.php';
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
            $protectora->email_visible = isset($_POST['emailVisibility']) ? 1 : 0;

            $data = [
                'nombre_protectora' => $protectora->nombre_protectora,
                'direccion' => $protectora->direccion,
                'telefono' => $protectora->telefono,
                'email' => $protectora->email,
                'id_provincia' => $protectora->id_provincia,
                'poblacion' => $protectora->poblacion,
                'web' => $protectora->web,
                'email_visible' => $protectora->email_visible,
                'password' => $_POST['password'], // Contraseña sin hashear, el método la hasheará
            ];


            //El nombre de la protectora ya existe: mostrar error
            if ($protectora->nombreExists($protectora->nombre_protectora)) {
                echo "<script>
                    alert('El nombre de la protectora ya existe. Por favor, elige otro.');
                    window.history.back();
                </script>";
                exit;
            }

            //El correo de la protectora ya existe: mostrar error
            if ($protectora->emailExists($protectora->email)) {
                echo "<script>
                    alert('El email de la protectora ya existe. Por favor, elige otro.');
                    window.history.back();
                </script>";
                exit;
            }

            // Llama al método para registrar la protectora
            if ($protectora->registerProtectora($data)) {
                echo "<script>
                        var redirectUrl = '" . dirname($_SERVER['PHP_SELF']) . "/index.php?page=home';
                        alert('Registro exitoso. Serás redirigido a la página principal.');
                        window.location.href = redirectUrl;
                </script>";
                require_once PROJECT_ROOT . '/src/controllers/LoginController.php';

            } else {
                echo "Error al registrar la protectora.";
            }
        }
        // Pasar los datos a la vista
        require_once PROJECT_ROOT . '/src/views/registroView.php';
    }

    public function getProvinciasProtectoras()
    {
        if (isset($_POST['ccaa_id'])) {
            $ccaaId = intval($_POST['ccaa_id']);

            // Modelo de Provincias
            $provinciasModel = new Provincias($this->conn);
            $provincias = $provinciasModel->getProvinciasByCcaaId($ccaaId);

            // Modelo de Protectoras
            $protectorasModel = new Protectora($this->conn);
            $protectoras = $protectorasModel->getProtectorasByCcaaId($ccaaId);

            // Responder con JSON
            echo json_encode([
                'provincias' => $provincias,
                'protectoras' => $protectoras
            ]);
        } else {
            echo json_encode(['error' => 'No se proporcionó una CCAA válida.']);
        }
    }
}
?>
