<?php
require_once PROJECT_ROOT . '/config/config.php';
require_once PROJECT_ROOT . '/src/models/Provincias.php';
require_once PROJECT_ROOT . '/src/models/Protectora.php';

class ProtectoraController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function register($data) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crea una instancia de Protectora y asigna los datos del formulario
            $protectora = new Protectora($this->conn);
            $protectora->nombre_protectora = $data['nombre_protectora'];
            $protectora->direccion = $data['direccion'];
            $protectora->telefono = $data['telefono'];
            $protectora->email = $data['email'];
            $protectora->id_provincia = $data['provincias'];
            $protectora->poblacion = $data['poblacion'];
            $protectora->web = $data['web'];
            $protectora->email_visible = isset($data['email_visible']) ? 1 : 0;
            $protectora->password_user = $data['password']; // Se pasa tal cual, el modelo se encarga de hacer el hash
    
            // El nombre de la protectora ya existe: mostrar error
            if ($protectora->nombreExists($protectora->nombre_protectora)) {
                echo "<script>
                    alert('El nombre de la protectora ya existe. Por favor, elige otro.');
                    window.history.back();
                </script>";
                exit;
            }
    
            // El correo de la protectora ya existe: mostrar error
            if ($protectora->emailExists($protectora->email)) {
                echo "<script>
                    alert('Este email ya se ha registrado. Por favor, elige otro.');
                    window.history.back();
                </script>";
                exit;
            }
    
            // Llama al método para registrar la protectora
            if ($protectora->registerProtectora()) {

                $user = $protectora->getProtectoraByEmail($data['email']);
                
                if ($user) {
                    // Iniciar sesión automáticamente
                    session_start();
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['nombre_protectora'] = $user['nombre_protectora'];

                    header(header: 'Location: ' . BASE_URL . 'index.php?page=busquedaPorProtectoras');

                    // Mensaje de éxito y redirección
                    $_SESSION['message'] = 'Protectora registrada exitosamente. Bienvenida a la plataforma.';
                    header(header: 'Location: ' . BASE_URL . 'index.php?page=busquedaPorProtectoras');
                    exit;
                } else {
                    $_SESSION['error'] = 'No se pudo iniciar sesión tras el registro. Por favor, inicia sesión manualmente.';
                    header("Location: " . BASE_URL . "/login.php");
                    exit;
                }
            } else {
                $_SESSION['error'] = 'No se pudo registrar la protectora. Inténtalo de nuevo más tarde.';
                header("Location: " . BASE_URL . "/registro.php");
                exit;
            }
        } else {
            // Manejo de método no permitido
            $_SESSION['error'] = 'Método no permitido.';
            header("Location: " . BASE_URL . "/registro.php");
            exit;
        }
    }

    public function getProvinciasByCCAA($id_ccaa) {
        $provinciaModel = new Provincias($this->conn);
        $ccaaModel = new CCAA($this->conn);
    
        // Obtener todas las CCAA
        $ccaas = $ccaaModel->getCCAA();
    
        // Obtener todas las provincias filtradas por CCAA
        $provincias = $provinciaModel->getProvinciasByCCAA($id_ccaa);
    
        // Pasamos las CCAA y las Provincias a la vista
        require_once PROJECT_ROOT . '/src/views/listadoProvinciasView.php';
    }

    
    public function getProtectorasByProvincia($id_provincia) {
        $protectoraModel = new Protectora($this->conn);
        $protectoras = $protectoraModel->getProtectorasByProvincia($id_provincia); // Método para obtener protectoras de la provincia
        
        return $protectoras;
    }


    public function getProtectoraByName($name)
    {
        try {
            $query = "SELECT * FROM protectoras WHERE nombre_protectora = :name";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener la protectora por nombre: " . $e->getMessage();
            return false;
        }
    }
    

    
}
?>
