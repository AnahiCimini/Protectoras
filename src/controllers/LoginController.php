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

            if (!$user) {
                echo "<script>alert('El usuario no existe. Verifica el correo electrónico ingresado.');</script>";
                exit;
            }

            if ($user && password_verify($password, $user['password_user'])) {
                // Credenciales válidas: iniciar sesión
                $_SESSION['email'] = $user['email'];

                header('Location: /Protectoras2/public_html/index.php?page=home');
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
        // Destruir la sesión
        session_unset();
        session_destroy();

        // Redirigir al usuario a la página de inicio
        header('Location: ' . PROJECT_ROOT . '/public_html/index.php?case=home');
                exit;
    }
}