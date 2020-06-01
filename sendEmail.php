<?php
    use PHPMailer\PHPMailer\PHPMailer;
    if (isset($_POST['name']) && isset($_POST['email'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];
        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "<LESSSECURE@EMAIL.COM>";
        $mail->Password = '<YOUR-PASSWORD>';
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";
        $mail->isHTML(true);
        $mail->setFrom($email, $name);
        $mail->addAddress("tagclub.vitu@gmail.com");
        $mail->Subject = $subject;
        $mail->Body = '<h3 align=left>NAME: '.$_POST['name'].'<br><br>EMAIL: '.$_POST['email'].'<br><br>MESSAGE: '.$_POST['body'].'</h3>';
        if ($mail->send()) {
            $status = "success";
            $response = "[--<> Email Sent Successfully <>--]";
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }
        exit(json_encode(array("status" => $status, "response" => $response)));
    }
?>
