<?php
    class Animal {
        private $conn;
        private $id_animal;
        private $id_protectora;
        private $id_especie;
        private $nombre_animal;
        private $descripcion;
        private $tamano;
        private $sexo;
        private $edad;
        private $raza;
        private $estado_salud;
        private $foto_principal;
        private $adoptado;
        private $urgente;
        private $en_acogida;
        private $esterilizado;

        public function __construct($db) {
            $this->conn = $db; // Almacena la conexión
        }


        public function getAnimalesPorFiltro($filtro, $valor) {
            if ($filtro === "especie"){
                $query = "SELECT a.*, e.nombre_especie FROM animales a
                JOIN especies e ON a.id_especie = e.id_especie
                WHERE e.nombre_especie = :valor";

                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':valor', $valor);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else if ($filtro === "nombre_protectora") {

                $query = "SELECT a.*, p.nombre_protectora FROM animales a
                JOIN protectoras p ON a.id_protectora = p.id_protectora
                WHERE p.nombre_protectora = :valor";

                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':valor', $valor);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else if ($filtro === "id_animal") {
                $query = "SELECT a.*, e.nombre_especie, p.nombre_protectora FROM animales a
                          JOIN especies e ON a.id_especie = e.id_especie
                          JOIN protectoras p ON a.id_protectora = p.id_protectora
                          WHERE a.id_animal = :valor";
        
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':valor', $valor);
                $stmt->execute();
        
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }

        public function getEspecieIdByName($nombre) {
            $query = "SELECT id_especie FROM especies WHERE nombre = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('s', $nombre);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($row = $result->fetch_assoc()) {
                return $row['id_especie'];
            }
            return null;
        }
    
        public function addAnimal($nombre_animal, $descripcion, $id_especie, $tamano, $sexo, $edad, $raza, $estado_salud, $foto_principal, $urgente, $en_acogida) {
            // SQL para insertar un nuevo animal en la base de datos
            $query = "INSERT INTO animales (nombre_animal, descripcion, id_especie, tamano, sexo, edad, raza, estado_salud, foto_principal, urgente, en_acogida) 
                      VALUES (:nombre_animal, :descripcion, :id_especie, :tamano, :sexo, :edad, :raza, :estado_salud, :foto_principal, :urgente, :en_acogida)";
    
            // Preparamos la consulta
            $stmt = $this->conn->prepare($query);
    
            // Vinculamos los parámetros
            $stmt->bindParam(':nombre_animal', $nombre_animal);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':id_especie', $id_especie);
            $stmt->bindParam(':tamano', $tamano);
            $stmt->bindParam(':sexo', $sexo);
            $stmt->bindParam(':edad', $edad);
            $stmt->bindParam(':raza', $raza);
            $stmt->bindParam(':estado_salud', $estado_salud);
            $stmt->bindParam(':foto_principal', $foto_principal);
            $stmt->bindParam(':urgente', $urgente);
            $stmt->bindParam(':en_acogida', $en_acogida);
    
            // Ejecutamos la consulta
            if ($stmt->execute()) {
                return true;
            }
            return false;
        }
            
    }

?>