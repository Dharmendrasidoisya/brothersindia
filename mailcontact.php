<?php
session_start();

$mykaptch = $_SESSION['scaptcha'];
$mycaptca = $_POST['captcha'];

if(isset($mycaptca) && $mycaptca !="" && $mykaptch == $mycaptca){

	    $curl = $_POST['curl'];

        $mydomain = "www.brothersindia.com";
        //$mydomain = "localhost";

        // Extract the domain from the referring URL
        $referer_domain = parse_url($curl, PHP_URL_HOST);

        // Check if the referring domain matches your domain
        if ($referer_domain === $mydomain) {

            if (empty($_POST["pname"])) {
                header("location:".$curl."");
                exit; // Exit function if condition is met
            }
            elseif (isset($_POST["name"])) {
                $name = $_POST["name"];
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                    header('location:contact.php');
                    exit; // Exit function if condition is met
                }
            }

            // Validate email
            elseif (isset($_POST["email"])) {
                $email = $_POST["email"];
                // check if e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    header('location:contact.php');
                    exit; // Exit function if condition is met
                }
            }

            // Validate message
            elseif (isset($_POST["message"])) {
                $message = $_POST["message"];
                // Check if message contains URL, email, or special characters
                if (preg_match("/\b(?:https?|ftp):\/\/|www\.|[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}\b|\W/", $message)) {
                    header('location:contact-us.php');
                    exit; // Exit function if condition is met
                }
            }

            // If all conditions pass, redirect to success page or perform additional actions

            // Exit function if all conditions pass

        } else {
            header('location:contact-us.php');
            exit; // Exit function if condition is met
        }
}else
{ ?>
	<script>
	alert("Please Enter Captcha Code");
//alert("<?php echo $_POST['captcha'] ?>");
    	window.location.href ="/contact-us.php";

    </script> <?php exit;
}


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

$subject = "Get It From BrothersIndia.Com";

/* message */
$message = "
<html>
<head>
    <title>New Inquiry - Get It From BrothersIndia.Com</title>
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
            <tr><td><strong>Product Name:</strong></td><td>{$_POST['pname']}</td></tr>
            <tr><td><strong>Name:</strong></td><td>{$_POST['name']}</td></tr>
            <tr><td><strong>Email:</strong></td><td>{$_POST['email']}</td></tr>
            <tr><td><strong>Phone Number:</strong></td><td>{$phone}</td></tr>
            <tr><td><strong>City/Location:</strong></td><td>{$_POST['city']}</td></tr>
            <tr><td><strong>Country:</strong></td><td>{$_POST['country_namenew']}</td></tr>
            <tr><td><strong>Message:</strong></td><td>{$_POST['message']}</td></tr>
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
   $mail->addBcc("jitendra@goadsindia.co.in");
    $mail->IsHTML(true);
    if(!$mail->Send()) {
        // return false;
        header('location:contact-us.php');
    } else {
        header('location:thankyou.php');
        // return true;
    }

?>