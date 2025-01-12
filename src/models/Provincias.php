<?php
class Provincias {
    private $conn; // Conexión a la base de datos
    public $id_provincia;
    public $id_ccaa;
    public $nombre_provincia;
   
    // Constructor que recibe la conexión a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todas las provincias
    public function getProvincias() {
        $query = "SELECT * FROM provincias ORDER BY nombre_provincia ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Obtener provincias por Comunidad Autónoma (id_ccaa)
public function getProvinciasByCCAA($id_ccaa) {
    $query = "SELECT * FROM provincias WHERE id_ccaa = :id_ccaa ORDER BY nombre_provincia ASC";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id_ccaa', $id_ccaa, PDO::PARAM_INT);
    $stmt->execute();
    $provincias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $provincias;
}
}
?>
