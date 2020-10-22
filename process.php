<?php
// Configure your Subject Prefix and Recipient here
$subjectPrefix = '[contacto de página web]';
$emailTo       = 'contacto@dieselguard.com.mx';
$errors = array(); // array to hold validation errors
$data   = array(); // array to pass back data

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = stripslashes(trim($_POST['name']));
    $email   = stripslashes(trim($_POST['email']));
    $phone = stripslashes(trim($_POST['phone']));
    $corp = stripslashes(trim($_POST['corp']));
    $message = stripslashes(trim($_POST['message']));

    // if (empty($name)) {
    //     $errors['name'] = 'El Nombre es requerido.';
    // }
    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     $errors['email'] = 'El email es requerido.';
    // }
    // if (empty($phone)) {
    //     $errors['phone'] = 'El teléfono es requerido.';
    // }
    // if (empty($message)) {
    //     $errors['message'] = 'Escribe un mensaje.';
    // }
    // if there are any errors in our errors array, return a success boolean or false
    // if (!empty($errors)) {
    //     $data['success'] = false;
    //     $data['errors']  = $errors;
    // } else {
        $subject = "$subjectPrefix $subject";
        $body    = '
            <strong>Nombre: </strong>'.$name.'<br />
            <strong>Nombre de la Empresa: </strong>'.$corp.'<br />
            <strong>Email: </strong>'.$email.'<br />
            <strong>Teléfono: </strong>'.$phone.'<br />
            <strong>Mensaje: </strong>'.nl2br($message).'<br />
        ';
        $headers  = "MIME-Version: 1.1" . PHP_EOL;
        $headers .= "Content-type: text/html; charset=utf-8" . PHP_EOL;
        $headers .= "Date: " . date('r', $_SERVER['REQUEST_TIME']) . PHP_EOL;
        $headers .= "From: " . "=?UTF-8?B?".base64_encode($name)."?=" . "<$email>" . PHP_EOL;
        $headers .= "Return-Path: $emailTo" . PHP_EOL;
        $headers .= "Reply-To: $email" . PHP_EOL;
        $headers .= "X-Mailer: PHP/". phpversion() . PHP_EOL;
        $headers .= "X-Originating-IP: " . $_SERVER['SERVER_ADDR'] . PHP_EOL;
        mail($emailTo,$subject, $body, $headers);
        $data['success'] = true;
      echo  $data['message'] = 'Diésel Guard. Tu mensaje se ha enviado con éxito!';
    // }
    // return all our data to an AJAX call
    // echo json_encode($data);
}
