<?php
class Provincias {
    private $conn; // Conexión a la base de datos
    public $id_provincia;
    public $id_ccaa;
    public $nombre_provincia;
   

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getProvincias() {
        $query = "SELECT * FROM provincias ORDER BY nombre_provincia ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProvinciasByCcaaId($ccaaId)
    {
        $stmt = $this->conn->prepare("SELECT id, nombre FROM provincias WHERE ccaa_id = ?");
        $stmt->bind_param("i", $ccaaId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>
