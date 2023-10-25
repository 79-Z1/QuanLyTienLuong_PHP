<?php
   include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/vendor/autoload.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    function send_mail($subject, $body, $email) {
        try {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug  = 0;
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP(); // gửi mail SMTP
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'thientrangdakhoa@gmail.com'; // SMTP username
            $mail->Password = 'ehut thvg xdvi caux'; // SMTP password
            $mail->SMTPSecure = 'ssl'; //Phương thức mã hóa dữ liệu - ssl: 465 hoặc tls:587
            $mail->Port = 465; // TCP port to connect to
    
            //Recipients
            $mail->setFrom('thientrangdakhoa@gmail.com', 'Da khoa Thien Trang');
            $mail->addReplyTo('thientrangdakhoa@gmail.com',"Email Reply");
            $mail->addAddress("$email"); // Name is optional
    
            // Content
            $mail->Subject = "$subject";
            $mail->isHTML(true);
            $mail->Body = $body;
            $mail->AltBody = "This is a plain-text message body";
    
            if($mail->send()) {
                echo "<script type='text/javascript'>toastr.success('Hãy kiểm tra hộp thư của bạn')</script>";
            }
        } catch (Exception $e) {
            echo $e;
            echo "<script type='text/javascript'>toastr.error('Gửi mail không thành công')</script>";
        }
    }
?>