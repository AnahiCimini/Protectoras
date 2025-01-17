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
            //$protectora->email_visible = isset($data['email_visible']) ? 1 : 0;
            $protectora->password_user = $data['password']; // Se pasa tal cual, el modelo se encarga de hacer el hash
    
            // Verificar si se subió un archivo
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = PROJECT_ROOT . '/public_html/assets/img/uploads/protectoras/';
                $uploadedFile = $uploadDir . basename($_FILES['logo']['name']);
                
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
            
                $fileName = uniqid('logo_') . '.' . pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
                $filePath = $uploadDir . $fileName;
            
                if (move_uploaded_file($_FILES['logo']['tmp_name'], $filePath)) {
                    $protectora->logo = $fileName;
                } else {
                    $_SESSION['error'] = 'Error al subir el logo. Inténtalo de nuevo.';
                    header("Location: " . BASE_URL . "/registro.php");
                    exit;
                }
            } else {
                $protectora->logo = null; // Si no se sube nada, la propiedad logo se establece como null
            }

            if ($_FILES['logo']['error'] !== UPLOAD_ERR_OK) {
                error_log("Error en la subida: " . $_FILES['logo']['error']);
            }

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


    public function getProtectoraByName($nombre_protectora)
    {
        try {
            $query = "SELECT * FROM protectoras WHERE nombre_protectora = :nombre_protectora";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nombre_protectora', $nombre_protectora, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener la protectora por nombre: " . $e->getMessage();
            return false;
        }
    }
    
    public function actualizarDatosProtectora()
    {
        session_start();

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['id_protectora'])) {
            header('Location: ' . BASE_URL . 'index.php?page=login');
            exit();
        }

        // Obtener el ID de la protectora desde la sesión
        $idProtectora = $_SESSION['id_protectora'];

        // Validar los datos enviados desde el formulario
        $direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
        $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
        $poblacion = filter_input(INPUT_POST, 'poblacion', FILTER_SANITIZE_STRING);
        $web = filter_input(INPUT_POST, 'web', FILTER_VALIDATE_URL);

        // Validar que los campos obligatorios no estén vacíos
        if (empty($direccion) || empty($telefono) || empty($poblacion)) {
            echo "<script>
                    alert('Los campos Dirección, Teléfono y Población son obligatorios.');
                    window.history.back();
                </script>";
            exit();
        }

        // Llamar al modelo para actualizar los datos de la protectora
        require_once PROJECT_ROOT . '/src/models/ProtectoraModel.php';
        $protectoraModel = new ProtectoraModel($this->conn);

        $actualizado = $protectoraModel->updateProtectora($idProtectora, $direccion, $telefono, $poblacion, $web);

        // Manejar el resultado de la actualización
        if ($actualizado) {
            $_SESSION['success'] = 'Los datos de la protectora se han actualizado correctamente.';
            header('Location: ' . BASE_URL . 'router.php?action=detalleProtectora&nombre_protectora=' . urlencode($_SESSION['nombre_protectora']));
        } else {
            echo "<script>
                    alert('Hubo un error al actualizar los datos. Por favor, inténtalo de nuevo.');
                    window.history.back();
                </script>";
        }

        exit();
    }

    
}
?>
