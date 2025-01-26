<?php
class Protectora {
    private $conn;
    public $id_protectora;
    public $nombre_protectora;
    public $direccion;
    public $telefono;
    public $email;
    public $id_provincia;
    public $poblacion;
    public $web;
    public $logo;
    //public $email_visible;
    public $password_user;


    public function __construct($db) {
        $this->conn = $db; // Almacena la conexión
    }

    // Obtener todas las protectoras
    public function getProtectoras() {
        $query = "SELECT * FROM protectoras ORDER BY nombre_protectora ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener las protectoras por provincia
    public function getProtectorasByProvincia($id_provincia) {
        $query = "SELECT * FROM protectoras WHERE id_provincia = :id_provincia";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_provincia', $id_provincia, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }   

    public function getProtectoraById($id) {
        $query = "SELECT * FROM protectoras WHERE id_protectora = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    


    // Obtener las protectoras por nombre
    public function getProtectoraByName($nombre_protectora) {
        $query = "SELECT * FROM protectoras WHERE nombre_protectora = :nombre_protectora";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre_protectora', $nombre_protectora, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buscar en la BBDD por email
    public function getProtectoraByEmail($email) {
        $query = "SELECT * FROM protectoras WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: false; // Devuelve false si no encuentra nada
    }


    public function exists($field, $value) {
        $query = "SELECT 1 FROM protectoras WHERE $field = :value";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':value', $value);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function registerProtectora() {
        // Hash de la contraseña aquí
        $hashedPassword = password_hash($this->password_user, PASSWORD_BCRYPT);
    
        $sql = "INSERT INTO protectoras (nombre_protectora, direccion, telefono, email, id_provincia, poblacion, web, logo, password_user) 
                VALUES (:nombre_protectora, :direccion, :telefono, :email, :id_provincia, :poblacion, :web, :logo, :password_user)";
        $stmt = $this->conn->prepare($sql);
    
        // Bind de parámetros
        $stmt->bindParam(':nombre_protectora', $this->nombre_protectora);
        $stmt->bindParam(':direccion', $this->direccion);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':id_provincia', $this->id_provincia);
        $stmt->bindParam(':poblacion', $this->poblacion);
        $stmt->bindParam(':web', $this->web);
        $stmt->bindParam(':logo', $this->logo);
        $stmt->bindParam(':password_user', $hashedPassword, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
       

    public function updateProtectora($id_protectora, $direccion, $telefono, $poblacion, $web)
    {    
        $query = "UPDATE protectoras 
                  SET direccion = :direccion, 
                      telefono = :telefono, 
                      poblacion = :poblacion, 
                      web = :web 
                  WHERE id_protectora = :id_protectora";
    
        $stmt = $this->conn->prepare($query);
    
        if (!$stmt) {
            // Error al preparar la consulta
            echo "<script>alert('Error al preparar la consulta SQL.');</script>";
            return false;
        }
    
        // Ejecutar la consulta
        $success = $stmt->execute([
            ':direccion' => $direccion,
            ':telefono' => $telefono,
            ':poblacion' => $poblacion,
            ':web' => $web,
            ':id_protectora' => $id_protectora
        ]);

        // Verificar si la consulta se ejecutó correctamente
        if ($success) {
            return true;
        } else {
            echo "<script>alert('Error al ejecutar la consulta SQL.');</script>";
            return false;
        }
    }
   
}
?>
