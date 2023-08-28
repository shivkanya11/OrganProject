<?php
$myusername="katareinfo@gmail.com";
 $auth="werwer2234wer324234";
		 $crt=date('d-m-Y');
		  $time=strtotime($crt);
		  //email code start 
require 'mail/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->Host = 'localhost';
$mail->SMTPAuth = true;
$mail->Username = 'alerts@balajiamines.in';
$mail->Password = 'balaji@123';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('alerts@balajiamines.in', 'Certifcate Expiry Alert');
$mail->addReplyTo('alerts@balajiamines.in', 'Certifcate Expiry Alert');

// Add a recipient
$mail->addAddress($myusername);

// Add cc or bcc 
$mail->addCC('');
$mail->addBCC('');

// Add attachments
$mail->addAttachment('');

// Email subject
$mail->Subject = 'Certifcate Expiry Alert';

// Set email format to HTML
$mail->isHTML(true);

// Email body content
$mailContent = "Hi ".$myusername.",
<br>Reset your password, and we'll get you on your way.<br>
To change your Reraforall password, click <a style href='http://www.reraforall.com/reset.php?auth=".$auth."&reset=".$time."'> here</a> or paste the following link into your browser:http://www.reraforall.com/reset.php?auth=".$auth."&reset=".$time."
This link will expire in 24 hours, so be sure to use it right away.<br>
Thank you for using Reraforall!<br>
The Reraforall Team.
    ";
$mail->Body = $mailContent;

// Send email
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
     $smg="<span style='color:white; background:Green; padding:5px;'>Reset Password Link Send To Your Register Email ID, Please Check Your Email Box Thank You ..!</span>";
}
// Send email End

?>
