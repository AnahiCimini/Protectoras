<?php

    require_once PROJECT_ROOT . '/src/models/Animal.php';


    class AnimalController {
        private $conn;
        public $animalmodel;
        
        public function __construct($conn) {
            $this->conn = $conn;
            $this->animalmodel = new Animal($this->conn);
        }

        public function buscarPorEspecie($especie) {
            // Llamar al modelo de animales para obtener los resultados
            return $this->animalmodel->getAnimalesPorFiltro('especie', $especie);
        }

        public function buscarPorProtectora($nombre_protectora) {
            // Llamar al modelo de animales para obtener los resultados
            return $this->animalmodel->getAnimalesPorFiltro('nombre_protectora', $nombre_protectora);
        }

        public function buscarPorID($id_animal) {
            $animal = $this->animalmodel->getAnimalesPorFiltro('id_animal', $id_animal);
            return $animal;
        }

        public function addCase() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Recogemos los datos del formulario
                $id_protectora = $_SESSION['id_protectora'];
                $nombre_animal = $_POST['nombre_animal'];
                $descripcion = $_POST['descripcion'];
                $id_especie = $_POST['id_especie'];
                $tamano = $_POST['tamano'];
                $sexo = $_POST['sexo'];
                $edad = $_POST['edad'];
                $raza = $_POST['raza'];
                $estado_salud = $_POST['estado_salud'];
                $esterilizado = $_POST['esterilizado'];
                $urgente = isset($_POST['urgente']) ? 1 : 0;
                $en_acogida = isset($_POST['en_acogida']) ? 1 : 0;
    
                // Procesamos la subida de la foto principal
                $foto_principal = null; // Iniciamos como null
                if (isset($_FILES['foto_principal']) && $_FILES['foto_principal']['error'] === UPLOAD_ERR_OK) {
                    // Obtener el nombre de la especie desde el dropdown
                    $especie = $_POST['nombre_especie']; // Tomamos el texto seleccionado del dropdown
                    $uploadDir = PROJECT_ROOT . '/public_html/assets/img/uploads/animales/' . ($especie) . '/';

                    // Crear la subcarpeta si no existe
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    // Nombre del archivo único
                    $fileName = uniqid('animal_') . '.' . pathinfo($_FILES['foto_principal']['name'], PATHINFO_EXTENSION);
                    $filePath = $uploadDir . $fileName;

                    // Intentamos mover el archivo subido
                    if (move_uploaded_file($_FILES['foto_principal']['tmp_name'], $filePath)) {
                        $foto_principal = $fileName;
                    } else {
                        $_SESSION['error'] = 'Error al subir la foto. Inténtalo de nuevo.';
                        header('Location: ' . BASE_URL . 'nuevoCaso.php');
                        exit;
                    }
                }

                // Llamamos al modelo de Animal y pasamos los datos a la función para añadir el nuevo caso
                $this->animalmodel->addAnimal(
                    id_protectora: $id_protectora, 
                    nombre_animal: $nombre_animal, 
                    descripcion: $descripcion, 
                    id_especie: $id_especie, 
                    tamano: $tamano, 
                    sexo: $sexo, 
                    edad: $edad, 
                    raza: $raza, 
                    estado_salud: $estado_salud, 
                    foto_principal: $foto_principal,
                    esterilizado: $esterilizado,
                    urgente: $urgente, 
                    en_acogida: $en_acogida
                );

                echo '<script>
                    alert("Animal registrado con éxito");
                    window.location.href = "' . BASE_URL . 'router.php?action=buscarPorProtectora&nombre_protectora=' . urlencode($_SESSION['nombre_protectora']) . '";
                </script>';
                exit;
            }
        }
        
        public function eliminarAnimal($id_animal) {
            // Llamamos al modelo de Animal para eliminar el animal por su ID
            if ($this->animalmodel->deleteAnimal($id_animal)) {
                echo '<script>
                    alert("Animal eliminado con éxito");
                    window.location.href = "' . BASE_URL . 'router.php?action=buscarPorProtectora&nombre_protectora=' . urlencode($_SESSION['nombre_protectora']) . '";
                </script>';
            } else {
                echo '<script>
                    alert("Error al eliminar el animal. Intenta de nuevo.");
                </script>';
            }
        }
        
    }

