<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reset password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/css/auth/enter_email.css" ?>" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/vendor/autoload.php");
    include_once("mail_format.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $email = isset($_POST['email']) ?  $_POST['email'] : '';
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (isset($_POST['recover-submit'])) {
        if ($email) {
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $query = "SELECT Email FROM nhan_vien WHERE Email='$email'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) <> 0) {
                // generate a unique random token of length 100
                $expFormat = mktime(
                    date("H"),
                    date("i"),
                    date("s"),
                    date("m"),
                    date("d") + 1,
                    date("Y")
                );
                $expDate = date("Y-m-d H:i:s", $expFormat);
                $key = md5($email);
                $key .= md5(time() + 123456789 % rand(4000, 55000000));
                $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
                $token = $key . $addKey;
                $sql = "INSERT INTO dat_lai_mat_khau(Email, Token, ExpDate) 
                    VALUES ('$email', '$token', '$expDate')";
                $results = mysqli_query($conn, $sql);

                $body = mail_format($token);
                $subject = "Password Recovery";
                $mail = new PHPMailer(true);
                try {
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
                    $mail->Subject = $subject;
                    // $mail->Body = "hmmmmm";
                    $mail->MsgHTML($body);
                    $mail->AltBody = "This is a plain-text message body";

                    $mail->send();
                    echo "<script type='text/javascript'>toastr.success('Hãy kiểm tra hộp thư của bạn')</script>";
                } catch (Exception $e) {
                    echo $e;
                    echo "<script type='text/javascript'>toastr.error('Gửi mail không thành công')</script>";
                }
            } else echo "<script type='text/javascript'>toastr.error('Email không tồn tại trên hệ thống')</script>";
        } else echo "<script type='text/javascript'>toastr.error('Sai định dạng email')</script>";
    }
    ?>
    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Forgot Password?</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">
                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                            <input id="email" name="email" value="<?= $email ?>" placeholder="email address" class="form-control" type="email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>