<?php
require_once PROJECT_ROOT . '/src/models/Protectora.php';

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
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $password = trim($_POST['password']);

            if (empty($email) || empty($password)) {
                $error = "Por favor, rellena todos los campos.";
                require_once PROJECT_ROOT . '/src/views/loginView.php';
                return;
            }
            

            // Buscar protectora por email
            $protectora = new Protectora($this->conn);
            $result = $protectora->getProtectoraByEmail($email);

            if ($result && password_verify($password, $result['password_user'])) {
                // Credenciales válidas: iniciar sesión
                $_SESSION['id_protectora'] = $result['id_protectora'];
                $_SESSION['nombre_protectora'] = $result['nombre_protectora'];
                $_SESSION['email'] = $result['email'];

                "<script>
                    var redirectUrl = '" . dirname($_SERVER['PHP_SELF']) . "/index.php?case=home';
                    window.location.href = redirectUrl;
                </script>";                exit;

            } else {
                // Credenciales inválidas
                $error = "<script>
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