<?php
    class Animal {
        private $conn;
        private $id_animal;
        private $id_protectora;
        private $id_especie;
        private $nombre_animal;
        private $raza;
        private $tamano;
        private $sexo;
        private $edad;
        private $estado_salud;
        private $foto_principal;
        private $fotos_adicionales;
        private $adoptado;
        private $urgente;
        private $en_acogida;
        private $esterilizado;
        private $fallecido;	

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
            }elseif ($filtro === "nombre_protectora") {

                $query = "SELECT a.*, p.nombre_protectora FROM animales a
                JOIN protectoras p ON a.id_protectora = p.id_protectora
                WHERE p.nombre_protectora = :valor";

                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':valor', $valor);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

        }

    }

?>