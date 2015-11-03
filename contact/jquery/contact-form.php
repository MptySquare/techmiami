<?php
$subjectPrefix = '[TechMiami Contact]';
$emailTo = 'dave@techmiami.net';
$msg = 'Oops! Something went wrong. Try emailing dave@techmiami.net';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = stripslashes(trim($_POST['form-name']));
    $email    = stripslashes(trim($_POST['form-email']));
    $subject  = stripslashes(trim($_POST['form-assunto']));
    $message  = stripslashes(trim($_POST['form-mensagem']));
    $pattern  = '/[\r\n]|Content-Type:|Bcc:|Cc:/i';

    if (preg_match($pattern, $name) || preg_match($pattern, $email) || preg_match($pattern, $subject)) {
        $msg = "Oops! Something went wrong.";
        die("Header injection detected");
    }

    $emailIsValid = preg_match('/^[^0-9][A-z0-9._%+-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/', $email);

    if($name && $email && $emailIsValid && $subject && $message){
        $subject = "$subjectPrefix $subject";
        $body = "Name: $name <br /> Email: $email <br /> Message: $message";

        $headers  = 'MIME-Version: 1.1' . PHP_EOL;
        $headers .= 'Content-type: text/html; charset=utf-8' . PHP_EOL;
        $headers .= "From: $name <$email>" . PHP_EOL;
        $headers .= "Return-Path: $emailTo" . PHP_EOL;
        $headers .= "Reply-To: $email" . PHP_EOL;
        $headers .= "X-Mailer: PHP/". phpversion() . PHP_EOL;

        mail($emailTo, $subject, $body, $headers);
        $msg = 'Success! Email sent.';

    }
}
  echo $msg;
?>
