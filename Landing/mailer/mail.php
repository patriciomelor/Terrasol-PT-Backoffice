<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $mensaje = $_POST['mensaje'];

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor
        $mail->SMTPDebug = SMTP::DEBUG_OFF; // Desactivar el debug en producción
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Reemplaza con tu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'user@example.com'; // Reemplaza con tu usuario SMTP
        $mail->Password = 'password'; // Reemplaza con tu contraseña SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port = 587; 

        // Destinatarios
        $mail->setFrom('no-reply@example.com', 'Tu Sitio Web'); // Reemplaza con tu email
        $mail->addAddress('destinatario@example.com', 'Nombre del Destinatario'); // Reemplaza con el email del destinatario

        // Contenido
        $mail->isHTML(true); 
        $mail->Subject = 'Nuevo mensaje de contacto';
        $mail->Body = "
            <p><strong>Nombre:</strong> $nombre $apellido</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Dirección:</strong> $direccion</p>
            <p><strong>Mensaje:</strong> $mensaje</p>
        ";

        $mail->send();
        echo 'Mensaje enviado correctamente';
    } catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
    }
}