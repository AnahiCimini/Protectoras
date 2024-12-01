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
    }


?>