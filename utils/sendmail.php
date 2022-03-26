<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include ('src/Exception.php');
require 'src/PHPMailer.php';
require 'src/SMTP.php';

function sendMail($mailTO,$emailTOName,$subject,$message){
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
        $mail->isSMTP();                                          
        $mail->Host       = 'ambs.dotpharma.rw';                    
        $mail->SMTPAuth   = true;                                  
        $mail->Username   = 'danny@ambs.dotpharma.rw';                    
        $mail->Password   = 'DannyP@111';                          
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        $mail->Port       = 465;
    
        $mail->setFrom('danny@ambs.dotpharma.rw', 'AMBS Notification');
        $mail->addAddress($mailTO, $emailTOName);

        $mail->isHTML(true);                              
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = $message;
    
        $mail->send();
        return "OK";
    } catch (Exception $e) {
        return "NOT";
    }
}
