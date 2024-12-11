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
            $protectora->password_user = password_hash($data['password'], PASSWORD_BCRYPT);
    
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
                    alert('El email de la protectora ya existe. Por favor, elige otro.');
                    window.history.back();
                </script>";
                exit;
            }
    
            // Llama al método para registrar la protectora
            if ($protectora->registerProtectora($data)) {
                echo "<script>
                    alert('Protectora registrada exitosamente.');
                    window.location.href = '" . BASE_URL . "/index.php?case=home';
                </script>";
            } else {
                echo "<script>
                    alert('No se pudo registrar la protectora.');
                    window.history.back();
                </script>";
            }
            exit;
        }
        // Si no es POST, simplemente retornamos un error de solicitud incorrecta
        echo "<script>
            alert('Método no permitido.');
            window.history.back();
        </script>";
        exit;
    }

    public function getProvinciasByCCAA($id_ccaa) {
        $provinciaModel = new Provincias($this->conn);
        $provincias = $provinciaModel->getProvinciasByCCAA($id_ccaa); // Obtener las provincias desde el modelo

        // Comprobar si hay provincias disponibles
        if (count($provincias) > 0) {
            foreach ($provincias as $provincia) {
                echo '<button type="button" class="btn btn-secondary provincia-button" data-id="' . $provincia['id_provincia'] . '">' . htmlspecialchars($provincia['nombre_provincia']) . '</button>';
            }
        } else {
            echo '<p>No hay provincias disponibles para esta Comunidad Autónoma.</p>';
        }
    }

    public function getListadoProtectoras($id_provincia) {
        $protectoraModel = new Protectora($this->conn);
        $protectoras = $protectoraModel->getProtectorasByProvincia($id_provincia);

        // Renderizar solo el listado de protectoras
        foreach ($protectoras as $protectora) {
            echo '<div class="card mt-2">
                    <div class="card-body">
                        <h5 class="card-title">' . htmlspecialchars($protectora['nombre_protectora']) . '</h5>
                        <p class="card-text">' . htmlspecialchars($protectora['descripcion']) . '</p>
                    </div>
                  </div>';
        }
    }
}
?>
