<?php
class Animal {

    public $id_animal;
    public $id_protectora;
    public $id_especie;
    public $nombre_animal;
    public $descripcion;
    public $raza;
    public $tamano;
    public $sexo;
    public $edad;
    public $estado_salud;
    public $foto_principal;
    public $fotos_adicionales;
    public $adoptado;
    public $urgente;
    public $en_acogida;
    public $esterilizado;
    public $fallecido;

    
    private $conn; // Conexión a la base de datos

    public function __construct($db) {
        $this->conn = $db; // Almacena la conexión
    }

    public function getAll() {
        $query = $this->conn->prepare("SELECT * FROM animales");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getByEspecie($especie) {
        $query = "SELECT a.* FROM animales a
                INNER JOIN especies e ON a.id_especie = e.id_especie
                WHERE e.nombre_especie = :especie";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':especie', $especie, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
