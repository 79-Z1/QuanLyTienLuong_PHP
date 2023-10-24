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
    <script src="<?= "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/js/auth/new_pass.js" ?>"></script>
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
    if (!isset($_GET['token'])) header('Location: ' . "/" . explode('/', $_SERVER['PHP_SELF'])[1]);
    $token = $_GET['token'];
    $sql = "select * from dat_lai_mat_khau where Token = '$token'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $curDate = date("Y-m-d H:i:s");
    $expDate = $row['ExpDate'];
    if ($curDate >= $expDate) {
        echo "<script type='text/javascript'>timeExpired()</script>";
    }
    if (mysqli_num_rows($result) <> 0) {
        if (isset($_POST['submit'])) {
            if (checkValid()) {
                $password = isset($_POST['password']) ? $_POST['password'] : '';
                $confimPass = isset($_POST['confirm-password']) ? $_POST['confirm-password'] : '';
                if (trim($password) === trim($confimPass)) {
                    $sql = "select MaNV from nhan_vien where Email like '$row[Email]'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $updateSQL = "UPDATE tai_khoan SET MatKhau = $password WHERE MaNV = '$row[MaNV]'";
                    mysqli_query($conn, $updateSQL);
                    echo "<script type='text/javascript'>
                        toastr.success('Đổi mật khẩu thành công');
                        setTimeout(function() {
                            window.location.href = 'http://localhost/QuanLyTienLuong_PHP';
                        }, 3000);
                    </script>";
                } else echo "<script type='text/javascript'>toastr.error('Mật khẩu không khớp')</script>";
            } else echo "<script type='text/javascript'>toastr.error('Vui lòng điền đầy đủ thông tin')</script>";
        }
    } else  header('Location: ' . "/" . explode('/', $_SERVER['PHP_SELF'])[1]);
    ?>
    <div class="mainDiv">
        <div class="cardStyle">
            <form action="" method="post" name="signupForm" id="signupForm">
                <img src="" id="signupLogo" />

                <h2 class="formTitle">
                    Thay đổi mật khẩu
                </h2>

                <div class="inputDiv">
                    <label class="inputLabel" for="password">Mật khẩu mới</label>
                    <input type="password" id="password" name="password">
                </div>

                <div class="inputDiv">
                    <label class="inputLabel" for="confirmPassword">Xác nhận mật khẩu</label>
                    <input type="password" id="confirmPassword" name="confirm-password">
                </div>

                <div class="buttonWrapper">
                    <button type="submit" name="submit" id="submitButton" class="submitButton pure-button pure-button-primary">
                        <span>Tiếp tục</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>