<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/css/auth/new_pass.css" ?>" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>
<?php
function checkValid(): bool
{
    if (isset($_POST['password']) && empty(trim($_POST['password']))) {
        return false;
    }
    if (isset($_POST['confirm-password']) && empty(trim($_POST['confirm-password']))) {
        return false;
    }
    return true;
}
?>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
    if (!isset($_GET['token'])) header('location:login.php');
    $token = $_GET['token'];
    $sql = "select * from dat_lai_mat_khau where Token = '$token'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if (mysqli_num_rows($result) <> 0) {
        if (isset($_POST['submit'])) {
            if (checkValid()) {
                $password = isset($_POST['password']) ? $_POST['password'] : '';
                $confimPass = isset($_POST['confirm-password']) ? $_POST['confirm-password'] : '';
                if(trim($password) === trim($confimPass)) {
                    $sql = "UPDATE tai_khoan SET MatKhau = $password WHERE Email = $row[Email]";
                    echo "<script type='text/javascript'>toastr.error('Đổi mật khẩu thành công')</script>";
                } else echo "<script type='text/javascript'>toastr.error('Mật khẩu không khớp')</script>";
            } else echo "<script type='text/javascript'>toastr.error('Vui lòng điền đầy đủ thông tin')</script>";
        }
    } else header('location:login.php');
    ?>
    <div class="mainDiv">
        <div class="cardStyle">
            <form action="" method="post" name="signupForm" id="signupForm">
                <img src="" id="signupLogo" />

                <h2 class="formTitle">
                    Change your account password
                </h2>

                <div class="inputDiv">
                    <label class="inputLabel" for="password">New Password</label>
                    <input type="password" id="password" name="password">
                </div>

                <div class="inputDiv">
                    <label class="inputLabel" for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirm-password">
                </div>

                <div class="buttonWrapper">
                    <button type="submit" name="submit" id="submitButton" class="submitButton pure-button pure-button-primary">
                        <span>Continue</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>