<?php
class Protectora {
    private $conn; // Conexión a la base de datos
    public $id_protectora;
    public $nombre_protectora;
    public $direccion;
    public $telefono;
    public $email;
    public $id_provincia;
    public $poblacion;
    public $web;
    //public $logo;
    public $email_visible;
    public $password_user;


    public function __construct($db) {
        $this->conn = $db; // Almacena la conexión
    }

    //Buscar en la BBDD por email
    public function getProtectoraByEmail($email) {
        $query = "SELECT * FROM protectoras WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    
        if ($stmt->execute()) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($user); 
            return $user;
        }
    
        return false;
    }
    //Comprobar si el nombre ya existe
    public function nombreExists($nombre_protectora) {
        $query = "SELECT COUNT(*) as count FROM protectoras WHERE nombre_protectora = :nombre_protectora";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre_protectora', $nombre_protectora, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
    public function emailExists($email) {
        $query = "SELECT COUNT(*) as count FROM protectoras WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }

    public function registerProtectora() {
        // Hash de la contraseña aquí
        $hashedPassword = password_hash($this->password_user, PASSWORD_BCRYPT);
    
        $sql = "INSERT INTO protectoras (nombre_protectora, direccion, telefono, email, id_provincia, poblacion, web, email_visible, password_user) 
                VALUES (:nombre_protectora, :direccion, :telefono, :email, :id_provincia, :poblacion, :web, :email_visible, :password_user)";
        $stmt = $this->conn->prepare($sql);
    
        // Bind de parámetros
        $stmt->bindParam(':nombre_protectora', $this->nombre_protectora);
        $stmt->bindParam(':direccion', $this->direccion);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':id_provincia', $this->id_provincia);
        $stmt->bindParam(':poblacion', $this->poblacion);
        $stmt->bindParam(':web', $this->web);
        $stmt->bindParam(':email_visible', $this->email_visible);
        $stmt->bindParam(':password_user', $hashedPassword, PDO::PARAM_STR);
    
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    


    // Obtener todas las protectoras
    public function getProtectoras() {
        $query = "SELECT * FROM protectoras ORDER BY nombre_protectora ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener las protectoras por provincia usando array_filter
    public function getProtectorasByProvincia($id_provincia) {
        $query = "SELECT * FROM protectoras WHERE id_provincia = :id_provincia ORDER BY nombre_protectora ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_provincia', $id_provincia);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
   
}
?>
