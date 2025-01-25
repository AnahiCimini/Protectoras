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
                $nombre_animal = $_POST['nombre_animal'];
                $descripcion = $_POST['descripcion'];
                $id_especie = $_POST['id_especie'];
                $tamano = $_POST['tamano'];
                $sexo = $_POST['sexo'];
                $edad = $_POST['edad'];
                $raza = $_POST['raza'];
                $estado_salud = $_POST['estado_salud'];
                $urgente = isset($_POST['urgente']) ? 1 : 0;
                $en_acogida = isset($_POST['en_acogida']) ? 1 : 0;
    
                // Procesamos la subida de la foto principal
                $foto_principal = null; // Iniciamos como null
                if (isset($_FILES['foto_principal']) && $_FILES['foto_principal']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = PROJECT_ROOT . '/public_html/assets/img/uploads/animales/';
                    $uploadedFile = $uploadDir . basename($_FILES['foto_principal']['name']);
    
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
    
                    $fileName = uniqid('animal_') . '.' . pathinfo($_FILES['foto_principal']['name'], PATHINFO_EXTENSION);
                    $filePath = $uploadDir . $fileName;
    
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
                    $nombre_animal, 
                    $descripcion, 
                    $id_especie, 
                    $tamano, 
                    $sexo, 
                    $edad, 
                    $raza, 
                    $estado_salud, 
                    $foto_principal, 
                    $urgente, 
                    $en_acogida
                );

                echo '<script>
                    alert("Animal registrado con éxito");
                    window.location.href = "' . BASE_URL . 'router.php?action=buscarPorProtectora&nombre_protectora=' . urlencode($_SESSION['nombre_protectora']) . '";
                </script>';
                exit;
            }
        }        
    }

