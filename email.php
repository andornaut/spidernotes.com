<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'
    && isset($_POST['submitNotSpam'])
    && !isset($_POST['submit'])
    && $_POST['name'] === '') {

    $email = sanitize('email', FILTER_SANITIZE_EMAIL);
    $message = sanitize('message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    send($email, $message);
    header('Location: /');
    die();
}

function sanitize($field_name, $sanitizer) {
    return isset($_POST[$field_name]) ? filter_var(trim($_POST[$field_name]), $sanitizer) : '';
}

function send($email, $message) {
    $message = wordwrap($message, 70, "\r\n");
    $charset = mb_detect_encoding($message);
    $headers  = "From: <$email>\r\nMIME-Version: 1.0\r\nContent-type: text/plain; charset=$charset\r\n";
    mail('info@spidernotes.com', 'SpiderNotes - Contact', $message, $headers);
}

?>
