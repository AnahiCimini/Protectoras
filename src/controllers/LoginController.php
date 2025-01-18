<?php
require_once PROJECT_ROOT . '/src/models/Protectora.php';
require_once PROJECT_ROOT . '/src/views/loginView.php';


class LoginController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function login() {
        // Verifica si la sesión ya está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        //Comprobar si el formulario se ha enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (empty($email) || empty($password)) {
                $error = "Por favor, rellena todos los campos.";
                require_once PROJECT_ROOT . '/src/views/loginView.php';
                return;
            }
            
            
            // Buscar protectora por email
            $protectora = new Protectora($this->conn);
            $user = $protectora->getProtectoraByEmail($email);

            if (!$user || empty($user['password_user'])) {
                echo "<script>
                    alert('El usuario no existe o tiene datos inválidos.');
                    window.history.back();
                </script>";
                exit;
            }

            if (!$user) {
                echo "<script>
                    alert('El usuario no existe. Verifica el correo electrónico ingresado.');
                    window.history.back();
                </script>";
                exit;
            }

            if ($user && password_verify($password, $user['password_user'])) {
                // Credenciales válidas: iniciar sesión
                $_SESSION['email'] = $user['email'];
                $_SESSION['id_protectora'] = $user['id_protectora'];
                $_SESSION['nombre_protectora'] = $user['nombre_protectora'];

                header('Location: ' . BASE_URL . 'router.php?action=buscarPorProtectora&nombre_protectora='.$_SESSION['nombre_protectora']);
                exit;

            } else {
                // Credenciales inválidas
                echo "<script>
                    alert('Email o contraseña incorrectos. Inténtalo de nuevo.');
                    window.history.back();
                </script>";
                
                exit;
            }
        }
        // Mostrar la vista de login
        require_once PROJECT_ROOT . '/src/views/loginView.php';
    }

    public function logout() {
        session_start(); // Asegura que la sesión está activa
        session_unset(); // Elimina todas las variables de sesión
        session_destroy();

        // Redirigir al usuario a la página de inicio
        header(header: 'Location: ' . BASE_URL . 'index.php?page=home');
        exit;
    }

}