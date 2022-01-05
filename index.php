<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\STMP;
use PHPMailer\PHPMailer\Exception;

require "./vendor/autoload.php";
$res="";
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $clientEmail = $_POST['email'];
    $query = $_POST['mesg'];
    $body = " <img src='cid:image_id1'>Hello <br> $query <br> from $name";
   
    try{
    $mail = new PHPMailer(true);
    $mail-> isSMTP();
    $mail->Host = "smtp.gmail.com";
    // provide your own email address here
    $mail-> Username = "YOUR_EMAIL_ADDRESS";
    // provide your own email account's password here
    $mail->Password = "YOUR PASSWORD";
    $mail->SMTPAuth=true;
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->setFrom($clientEmail);
    // provide your own email address here
    $mail->addAddress('YOUR_EMAIL_ADDRESS');
    $mail->isHTML(true);
    $mail->Subject="Contact Us Message";
    $mail->Body = $body;
    $mail->AltBody = strip_tags($body);
    $mail->addAttachment("hardwareComponents.png");
    $mail->addEmbeddedImage("hardwareComponents.png", 'image_id1');
    $mail->send();
    $res="Email Sent Successfully";

    }catch(Exception $e){$res="Mail Sent Error: $mail->ErrorInfo";}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Contact Us</title>
</head>
<body>
    <h1>Contact Us Form</h1>
    <form action="index.php" method="POST">
   <div> <input type="text" name="name" placeholder="Full Name"></div>
    <div><input type="email" name="email" placeholder="Email"></div>
   <div> <textarea name="mesg" cols="30" rows="10" placeholder="Message..."></textarea></div>
    <div>
        <span><?php echo $res?></span>
    <input type="submit" name="submit" value="Send Message">
    </div>
    </form>
</body>
</html>