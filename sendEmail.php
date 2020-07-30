<?php
require 'vendor/autoload.php';

if (isset($_POST['name']) && isset($_POST['email']))
{
    $MAIN_KEY="YOUR_SENDGRID_API_KEY";

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom("admin@tagclub.in", "TAG Official");
    $email->setSubject($subject);
    $email->addTo("ADMIN_RECIEVER@MAIL.COM", "Admin_Name");
    $email->addContent("text/html", '<h3 align=left>NAME: '.$_POST['name'].'<br><br>EMAIL: '.$_POST['email'].'<br><br>MESSAGE: '.$_POST['body'].'</h3>');

    $sendgrid = new \SendGrid($MAIN_KEY);
    $response = $sendgrid->send($email);

    $res=$response->statusCode();  // Unauth->404      Success->202

    if($res == "202")
    {
        $status="success";
        $response = "Email Sent Successfully";
    }
    else
    {
        $status="failed";
        $response = "Failed ".$res." Error Encountered.";
    }
    exit(json_encode(array("Status" => $status, "Response_Status_Code" => $res)));
}
?>
