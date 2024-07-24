<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load the PHPMailer library
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/SMTP.php';

$errorMSG = "";

// NAME
if (empty($_POST["name"])) {
    $errorMSG = "El nombre es obligatorio ";
} else {
    $name = $_POST["name"];
}

// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "El correo es obligatorio";
} else {
    $email = $_POST["email"];
}

// PHONE
if (empty($_POST["phone"])) {
    $errorMSG .= "El telefono es obligatorio";
} else {
    $phone = $_POST["phone"];
}

// SUBJECT
if (empty($_POST["subject"])) {
    $errorMSG .= "El asunto es obligatorio";
} else {
    $subject = $_POST["subject"];
}

// MESSAGE
if (empty($_POST["message"])) {
    $errorMSG .= "El mensaje es obligatorio";
} else {
    $message = $_POST["message"];
}

if (empty($errorMSG)) {
    // Configuración de PHPMailer
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'mail.tsn-cloud.com';
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Port = 587;
    $mail->Username = 'tsnegoc9';
    $mail->Password = '#TSnegocios2024';

    // Establecer el remitente
    $mail->setFrom('jose.davila.b@tecsup.edu.pe', 'BOOLTHOR');

    // Establecer la dirección de correo electrónico del destinatario
    $mail->addAddress('jose.davila.b@tecsup.edu.pe');

    $mail->Subject = 'Nuevo mensaje recibido desde BOOLTHOR';
    $mail->Body = "Nombre: $name\nEmail: $email\nTelefono: $phone\nAsunto: $subject\nMensaje: $message";

    try {
        $mail->send();
        echo 'success';
    } catch (Exception $e) {
        echo "error";
        //error_log('Error en el envío de correo: ' . $e->getMessage());
        //echo 'Something went wrong: ' . $mail->ErrorInfo;
        // Debug errors
        //$mail->SMTPDebug = SMTP::DEBUG_CONNECTION;
    }
} else {
    echo $errorMSG;
}
?>
