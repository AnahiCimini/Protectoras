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
            $this->conn = $db;
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

        public function getIdEspecieByNombre($nombreEspecie)
        {
            $sql = "SELECT id_especie FROM especies WHERE nombre_especie = :nombreEspecie";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nombreEspecie', $nombreEspecie, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchColumn();
        }

        public function getNombreEspecieById($idEspecie)
        {
            $sql = "SELECT nombre_especie FROM especies WHERE id_especie = :idEspecie";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idEspecie', $idEspecie, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchColumn();
        }
    
        public function addAnimal($id_protectora, $nombre_animal, $descripcion, $id_especie, $tamano, $sexo, $edad, $raza, $estado_salud, $foto_principal, $esterilizado, $urgente, $en_acogida) {
            $query = "INSERT INTO animales (id_protectora, nombre_animal, descripcion, id_especie, tamano, sexo, edad, raza, estado_salud, foto_principal, esterilizado, urgente, en_acogida) 
                      VALUES (:id_protectora, :nombre_animal, :descripcion, :id_especie, :tamano, :sexo, :edad, :raza, :estado_salud, :foto_principal, :esterilizado, :urgente, :en_acogida)";
    
            $stmt = $this->conn->prepare($query);
    
            $stmt->bindParam(':id_protectora', $id_protectora);
            $stmt->bindParam(':nombre_animal', $nombre_animal);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':id_especie', $id_especie);
            $stmt->bindParam(':tamano', $tamano);
            $stmt->bindParam(':sexo', $sexo);
            $stmt->bindParam(':edad', $edad);
            $stmt->bindParam(':raza', $raza);
            $stmt->bindParam(':estado_salud', $estado_salud);
            $stmt->bindParam(':foto_principal', $foto_principal);
            $stmt->bindParam(':esterilizado', $esterilizado);
            $stmt->bindParam(':urgente', $urgente);
            $stmt->bindParam(':en_acogida', $en_acogida);
    
            if ($stmt->execute()) {
                return true;
            }
            return false;
        }
            
        public function deleteAnimal($id_animal) {
            $query = "DELETE FROM animales WHERE id_animal = :id_animal";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_animal', $id_animal);
        
            return $stmt->execute();
        }
        
        public function actualizarDatosAnimal($id_animal, $data){
            $foto_principal = $data['foto_principal'];
            $nombre_animal = $data['nombre_animal'];
            $raza = $data['raza'];
            $edad = $data['edad'];
            $tamano = $data['tamano'];
            $estado_salud = $data['estado_salud'];
            $sexo = $data['sexo'];
            $esterilizado = $data['esterilizado'];
            $urgente = $data['urgente'];
            $adoptado = $data['adoptado'];
            $en_acogida = $data['en_acogida'];
            $descripcion = $data['descripcion'];
        
            $query = "UPDATE animales SET 
                    foto_principal = ?,
                    nombre_animal = ?,
                    raza = ?, 
                    edad = ?, 
                    tamano = ?, 
                    estado_salud = ?, 
                    sexo = ?, 
                    esterilizado = ?, 
                    urgente = ?, 
                    adoptado = ?, 
                    en_acogida = ?, 
                    descripcion = ? 
                    WHERE id_animal = ?";
        
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$foto_principal, $nombre_animal, $raza, $edad, $tamano, $estado_salud, $sexo, $esterilizado, $urgente, $adoptado, $en_acogida, $descripcion, $id_animal]);
        
            return true;
        }
        
    }

?>