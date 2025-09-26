<?php

// Ambil input
$email   = $_POST['destination'];
$subject = $_POST['subject'];

$emailnorep = $_POST['sender'];
$replyTo    = isset($_POST['replyto']) ? trim($_POST['replyto']) : '';

// Email tujuan dan judul email
$to = $email; // Ganti dengan email tujuan sebenarnya
$mailSubject = $subject;

// Header email
$headers  = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
$headers .= "From: <$emailnorep>" . "\r\n";

if (!empty($replyTo)) {
    $headers .= "Reply-To: <$replyTo>" . "\r\n";
}

// Ambil isi template sebagai string
$body = $_POST['html'];

// Kirim email
if (mail($to, $mailSubject, $body, $headers)) {
    echo "success";
} else {
    echo "failed";
}
?>
