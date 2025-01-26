<?php
    require_once PROJECT_ROOT . '/config/config.php';
    require_once PROJECT_ROOT . '/src/models/Formularios.php';
    

    class FormulariosController {

        // Método para procesar el formulario de contacto con la protectora
        public function procesarContacto() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombreContacto = $_POST['nombreContacto'] ?? '';
                $emailContacto = $_POST['emailContacto'] ?? '';
                $mensajeContacto = $_POST['mensajeContacto'] ?? '';
                $correoProtectora = $_POST['correoProtectora'] ?? ''; 
    
                // Llamar al modelo para enviar el correo
                if (Formularios::enviarCorreoContacto($nombreContacto, $emailContacto, $mensajeContacto, $correoProtectora)) {
                    echo "<script>
                        alert('Mensaje enviado con éxito.');
                        window.history.back();
                    </script>";
                    exit();
                } else {
                    echo "<script>
                        alert('Error al enviar el correo. Inténtalo de nuevo.');
                        window.history.back();
                    </script>";
                }
            }
        }
    
        // Método para procesar el formulario de contacto con el administrador
        public function procesarFormularioAdministrador() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $mensajeContacto = $_POST['mensajeContacto'] ?? '';
                $correoProtectora = $_POST['correoProtectora'] ?? '';

                // Llamar al modelo para enviar el correo al administrador
                if (Formularios::enviarCorreoAdministrador($mensajeContacto, $correoProtectora)) {
                    echo "<script>
                        alert('Mensaje enviado con éxito.');
                        window.history.back();
                    </script>";
                    exit();
                } else {
                    echo "<script>
                        alert('Error al enviar el correo. Inténtalo de nuevo.');
                        window.history.back();
                    </script>";
                }
            }
        }

        public function peticionInformacionCaso (){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombre_animal = $_POST['nombre_animal'] ?? '';
                $id_animal = $_POST['id_animal'] ?? '';
                $nombreInteresado = $_POST['nombreInteresado'] ?? '';
                $emailInteresado = $_POST['emailInteresado'] ?? '';
                $telefonoInteresado = $_POST['telefonoInteresado'] ?? '';
                $mensaje = $_POST['mensaje'] ?? '';
                $mail_protectora = $_POST['mail_protectora'] ?? '';

                // Llamar al modelo para enviar el correo al administrador
                if (Formularios::enviarCorreoInformacion($nombre_animal, $nombreInteresado, $emailInteresado, $telefonoInteresado, $mensaje, $mail_protectora)) {
                    echo "<script>
                        alert('Mensaje enviado con éxito.');
                        window.location.href = 'router.php?action=detalleAnimal&id_animal=" . $id_animal . "';
                    </script>";
                    exit();
                } else {
                    echo "<script>
                        alert('Error al enviar el correo. Inténtalo de nuevo.');
                        window.history.back();
                    </script>";
                }
            }
        }
    }