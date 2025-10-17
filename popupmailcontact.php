<?php
  //    echo '<pre>';
//    print_r($_POST);
//    echo '</pre>';
//    exit;


$domain = 'brothersindia.com';

if (checkdnsrr($domain, "A") || checkdnsrr($domain, "MX")) {
    echo "Valid domain";
} else {
    echo "Invalid or unreachable domain";
}

$email = $_POST['email'];

$domain = substr(strrchr($email, "@"), 1);

if (checkdnsrr($domain, "MX")) {
    echo "Valid email domain.";
} else {
    echo "Invalid email domain.";
}

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'PHPMailer/PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer/PHPMailer.php';
require 'PHPMailer/PHPMailer/SMTP.php';


$pname = $_POST['pname'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$city = $_POST['city'];
$country_namenew = $_POST['country_namenew'];
$country_namenew = utf8_encode($country_namenew);
/* recipients */
$to  = $_POST['recipient'];

$subject = "Get It BrothersIndia.Com";

/* message */
$message = "
<html>
<head>
    <title>New Inquiry - BrothersIndia.Com</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { background-color: #ffffff; padding: 20px; border-radius: 5px; max-width: 600px; margin: auto; }
        h2 { background-color: #007bff; color: white; padding: 10px; text-align: center; border-radius: 10px;}
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        .footer { text-align: center; font-size: 12px; color: #777; margin-top: 10px; }
    </style>
</head>
<body>
    <div class='container' style='margin: inherit !important'>
        <h2>New Inquiry Details</h2>
        <table>
            <tr><td><strong>Name:</strong></td><td>{$_POST['name']}</td></tr>
            <tr><td><strong>Email:</strong></td><td>{$_POST['email']}</td></tr>
            <tr><td><strong>Phone Number:</strong></td><td>{$phone}</td></tr>
            <tr><td><strong>City/Location:</strong></td><td>{$_POST['city']}</td></tr>
            <tr><td><strong>Country:</strong></td><td>{$_POST['country_namenew']}</td></tr>
            <tr><td><strong>Message:</strong></td><td>{$_POST['message']}</td></tr>
            <tr><td><strong>Source:</strong></td><td>{$_POST['pname']}</td></tr>
        </table>
        <div class='footer'>
            <p>Sent from <strong>Brothers India</strong></p>
        </div>
    </div>
</body>
</html>
";
$from = $_POST['name'];
/* To send HTML mail, you can set the Content-type header. */
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
/* additional headers */
$headers .= "From: $name<$email>\r\n";

$form_fields = array_keys($_POST);
for ($i = 3; $i < sizeof($form_fields)-1; $i++)
{
    $field = "";
    $value = "";
    $thisField = $form_fields[$i];
    $field = $thisField;
    $thisValue = $_POST[$thisField];
    $value = $thisValue;
    $message1 .= $field ." = ". $value."<br />";
}


//Create a new PHPMailer instance
$mail = new PHPMailer(true);

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = "brothers.in";

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'TLS';

//Whether to use SMTP authentication
//$mail->SMTPAuth = true;

//Set the subject line
$mail->Subject = 'Get It From Brothers India';

    $mail->Username = 'info@brothers.in';
    $mail->Password = 'Eastwest#4321@';
    $mail->SetFrom('info@brothers.in', 'Get It From Brothers India');

    $mail->Body = $message;
    $mail->AltBody = $message;
   $mail->AddAddress('info@brothersindia.com');  //send address
   $mail->AddReplyTo($email);
   //$mail->addBcc("jitendra@goadsindia.co.in");
   $mail->addBcc("rutvik@indiantradebird.com");
    $mail->IsHTML(true);
    if(!$mail->Send()) {
        // return false;
        header('location:contact-us.php');
    } else {
        header('location:thankyou.html');
        // return true;
    }

?>