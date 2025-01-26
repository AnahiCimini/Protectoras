<?php
require_once PROJECT_ROOT . '/src/libs/PHPMailer/PHPMailer.php';
require_once PROJECT_ROOT . '/src/libs/PHPMailer/SMTP.php';
require_once PROJECT_ROOT . '/src/libs/PHPMailer/Exception.php';

class Formularios {
    public static function enviarCorreoContacto($nombre, $email, $mensaje, $correoProtectora) {
        $mail = new PHPMailer\PHPMailer\PHPMailer(true); // Usamos la clase PHPMailer directamente

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp-relay.brevo.com';
            $mail->SMTPAuth = true;
            $mail->Username = '845a16001@smtp-brevo.com';
            $mail->Password = '52P0Sf3OpBqchCGT';
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Remitente y destinatario
            $mail->setFrom('noetrip84@gmail.com', $nombre);  // Correo del remitente
            $mail->addAddress($correoProtectora);  // Correo de la protectora

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Nuevo mensaje de contacto desde el sitio web';
            $mail->Body = "Nombre: $nombre<br>Email: $email<br>Mensaje:<br>$mensaje";
            $mail->addReplyTo($email);


            // Enviar el correo
            $mail->send();
            return true;  // Si se envía correctamente
        } catch (Exception $e) {
            return false;  // Si hay un error al enviar
        }
    }

    public static function enviarCorreoAdministrador($mensaje, $correoProtectora) {
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);  // Usamos la clase PHPMailer directamente

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp-relay.sendinblue.com';  // Servidor SMTP de Sendinblue
            $mail->SMTPAuth = true;
            $mail->Username = '845a16001@smtp-brevo.com';
            $mail->Password = '52P0Sf3OpBqchCGT';
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Remitente y destinatario
            $mail->setFrom('noetrip84@gmail.com', $correoProtectora);  // Correo de la protectora
            $mail->addAddress('noeliacimini@gmail.com');  // Correo del administrador

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Solicitud de cambio en la protectora';
            $mail->Body = "Mensaje:<br>$mensaje";
            $mail->addReplyTo($correoProtectora);

            // Enviar el correo
            $mail->send();
            return true;  // Si se envía correctamente
        } catch (Exception $e) {
            return false;  // Si hay un error al enviar
        }
    }
}
