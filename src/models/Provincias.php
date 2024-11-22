<?php
class Provincias {
    private $db; // Conexión a la base de datos
    public $id_provincia;
    public $id_ccaa;
    public $nombre_provincia;
   

    public function __construct($db) {
        $this->db = $db;
    }

    public function getProvincias() {
        $query = "SELECT * FROM provincias ORDER BY nombre_provincia ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
