<?php

    define('DB_HOST', 'localhost');
    define('DB_NAME', 'adopciones_animales');
    define('DB_USER', 'root');
    define('DB_PASS', '');

class Database {
    public $conn;
    

    // Método para conectar a la base de datos
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Conexión fallida: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
