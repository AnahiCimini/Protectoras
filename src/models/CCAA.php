<?php
class CCAA {
    private $conn; // Conexión a la base de datos
    public $id_ccaa;
    public $nombre_ccaa;
   
    // Constructor que recibe la conexión a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    public function getCCAA() {
        $query = "SELECT * FROM comunidades_autonomas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        $ccaas = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Renombramos la variable a $ccaas
        return $ccaas;  // Devolvemos el array con el nombre de $ccaas
    }

}
?>
