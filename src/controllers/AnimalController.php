<?php
require_once PROJECT_ROOT . '/src/models/Animal.php';


class AnimalController {
    private $conn;
    public $animales;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function buscarPorEspecie($especie) {

        $animal = new Animal($this->conn);
        $animales = $animal->getByEspecie($especie);

        // Pasar los resultados a la vista sin hacer require_once del index
        return $animales;  // Devolver los animales encontrados
        
    }
}
?>