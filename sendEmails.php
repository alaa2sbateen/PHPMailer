<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';



ob_start();
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Mailer = "smtp";

    $mail->SMTPDebug  = 1;
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "ahmad2sbateen@gmail.com";
    $mail->Password   = "0799322870";


    $name = $_POST['full-name'];
    $email = $_POST['e-mail'];
    $phone = $_POST['phone'];
    $job = $_POST['job'];
    $address = $_POST['address'];
    $textArea = $_POST['note'];
    $treatPatient = $_POST['donate-sec'];

    $subject = $_POST['subject'];
    $send_email = $_POST['send-email'];


    $file_name = $_FILES['picture']['name'];
    $file_size = $_FILES['picture']['size'];
    $file_tmp = $_FILES['picture']['tmp_name'];
    $file_type = $_FILES['picture']['type'];



    move_uploaded_file($file_tmp, "images/" . $file_name);
    $mail->AddEmbeddedImage("images/" . $file_name, 'profile_pic');


    $mail->IsHTML(true);
    $mail->AddAddress($send_email);
    $mail->SetFrom("ahmad2sbateen@gmail.com", "Thank you Jordan !!");
    $mail->Subject = $subject;


    $content = "<table style=\"display:flex;flex-direction:row;align-items:flex-start;\">
        <tr><h1 style=\"color:red;font-size: 16px\">Name :  ${name}</h1></tr>
        <tr><h1 style=\"color:red;font-size: 16px\">Email :  ${email}</h1></tr>
        <tr><h1 style=\"color:red;font-size: 16px\">Phone :  ${phone}</h1></tr>
        <tr><h1 style=\"color:red;font-size: 16px\">Job :  ${job}</h1></tr>
        <tr><h1 style=\"color:red;font-size: 16px\">Address :  ${address}</h1></tr>
        <tr><h1 style=\"color:red;font-size: 16px\">Note :  ${textArea}</h1></tr>
        <tr><h1 style=\"color:red;font-size: 16px\">isTreatPatient :  ${treatPatient}</h1></tr>
        <tr><h1 style=\"color:red;font-size: 16px\">Profile Pic : </h1></tr>
        <tr><img src=\"cid:profile_pic\" alt=\"Girl in a jacket\" width=\"500\" height=\"600\"></tr>
    </table>";

    $mail->MsgHTML($content);
    if (!$mail->Send()) {
        ob_end_clean();
        header("Location: https://alaa2sbateen.github.io/ThankYouJordan/");
        die();
    } else {
        ob_end_clean();
        header("Location: https://alaa2sbateen.github.io/ThankYouJordan/");
        die();
    }
} catch (Exception $e) {
    ob_end_clean();
    header("Location: https://alaa2sbateen.github.io/ThankYouJordan/");
    die();
}
