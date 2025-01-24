<?php
require_once PROJECT_ROOT . '/config/config.php';
require_once PROJECT_ROOT . '/src/models/Provincias.php';
require_once PROJECT_ROOT . '/src/models/Protectora.php';
require_once PROJECT_ROOT . '/src/utils/utils.php';


class ProtectoraController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
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
        $protectoras = $protectoraModel->getProtectorasByProvincia($id_provincia);
        return $protectoras;
    }

    public function getProtectoraByName($nombre_protectora) {
        $protectora = new Protectora($this->conn);
        $protectoras = $protectora->getProtectoraByName($nombre_protectora);
        return $protectoras;
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
                    header(header: 'Location: ' . BASE_URL . 'index.php?page=login');
                    exit;
                }
            } else {
                $protectora->logo = null; // Si no se sube nada, la propiedad logo se establece como null
            }

            if ($_FILES['logo']['error'] !== UPLOAD_ERR_OK) {
                error_log("Error en la subida: " . $_FILES['logo']['error']);
            }

            // Verificar existencia de nombre o email
            if ($protectora->exists('nombre_protectora', $protectora->nombre_protectora)) {
                echo "<script>alert('El nombre de la protectora ya existe.'); window.history.back();</script>";
                exit;
            }

            if ($protectora->exists('email', $protectora->email)) {
                echo "<script>alert('Este email ya se ha registrado.'); window.history.back();</script>";
                exit;
            }

    
            // Llama al método para registrar la protectora
            if ($protectora->registerProtectora()) {

                $user = $protectora->getProtectoraByEmail($data['email']);
                
                if ($user) {
                    // Iniciar sesión automáticamente
                    session_start();
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['id_protectora'] = $user['id_protectora'];
                    $_SESSION['nombre_protectora'] = $user['nombre_protectora'];

                    // Mensaje de éxito y redirección
                    $_SESSION['message'] = 'Protectora registrada exitosamente. Bienvenida a la plataforma.';
                    header('Location: ' . BASE_URL . 'router.php?action=buscarPorProtectora&nombre_protectora=' . urlencode($_SESSION['nombre_protectora']));
                    exit;
                } else {
                    $_SESSION['error'] = 'No se pudo iniciar sesión tras el registro. Por favor, inicia sesión manualmente.';
                    header(header: 'Location: ' . BASE_URL . 'index.php?page=login');
                    exit;
                }
            } else {
                echo "<script>
                    alert('No se pudo registrar la protectora. Inténtalo de nuevo más tarde.');
                    window.history.back();
                </script>";
            }
        } else {
            // Manejo de método no permitido
            $_SESSION['error'] = 'Método no permitido.';
            header(header: 'Location: ' . BASE_URL . 'index.php?page=registro');
            exit;
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
        $id_protectora = $_SESSION['id_protectora'] ?? null;

        if ($id_protectora === null) {
            echo "<script>alert('No se ha encontrado el ID de la protectora en la sesión.');</script>";
            exit;
        }

        // Validar los datos enviados desde el formulario
        $direccion = filter_input(INPUT_POST, 'direccion');
        $telefono = filter_input(INPUT_POST, 'telefono');
        $poblacion = filter_input(INPUT_POST, 'poblacion');
        $web = filter_input(INPUT_POST, 'web');

        // Verificar que los datos sean recibidos correctamente desde el formulario
        if (empty($direccion) || empty($telefono) || empty($poblacion) || empty($web)) {
            echo "<script>
                alert('Faltan datos en el formulario.');
                window.history.back();
            </script>";
            exit;
        }

        // Llamar al modelo para actualizar los datos de la protectora
        require_once PROJECT_ROOT . '/src/models/Protectora.php';
        $protectora = new Protectora($this->conn);

        $actualizado = $protectora->updateProtectora($id_protectora, $direccion, $telefono, $poblacion, $web);

        // Manejar el resultado de la actualización
        if ($actualizado) {
            echo "<script>
                    alert('Los datos se han modificado correctamente.');
                    window.location.href = '" . BASE_URL . "router.php?action=detalleProtectora&nombre_protectora=" . urlencode($_SESSION['nombre_protectora']) . "';
                </script>";
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
