<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<?php 
    if(isset($_POST['username']))
        $username = trim($_POST['username']);
    else $username="";

    if(isset($_POST['pass']))
        $pass = trim($_POST['pass']);
    else $pass="";
    $isLogin;
    $action = "";
    $error = array();
    if(isset($_POST['login'])){
        if($username!="" && $pass!=""){
            require("connect_qlbs.php");
            $sql = 'select user_name, password from user';
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) <> 0) {
                while ($rows = mysqli_fetch_array($result)) {
                    if($username == $rows['user_name'] && $pass == $rows['password']){
                        $error[] = "Đăng nhập thành công";
                        $isLogin = true;
                        header("Location: ?page=TNT-QLBS-List-KH");
                        break;
                    }
                    $isLogin = false;
                }
            }
            if($isLogin == false)  $error[] = "Đăng nhập không thành công!<br> Vui lòng xem lại tài khoản mật khẩu";
        }
        if($username==""){
            $error[]="Vui lòng nhập Username";
        }
        if($pass==""){
            $error[]="Vui lòng nhập Password";
        }
    }
?>

<body>
    <form action="" method="post">
        <table>
            <tr align="center">
                <td colspan="2"><b><h2>Login</h2></b></td>
            </tr>
            <tr align="center">
                <td>Username</td>
                <td><input type="text" name="username" value="<?php echo $username;?>"></td>
            </tr>
            <tr align="center">
                <td>Password</td>
                <td><input type="password" name="pass" value="<?php echo $pass;?>"></td>
            </tr>
            <tr align="center">
                <td colspan="2"><input type="submit" name="login" value="Login"></td>
            </tr>
            <tr>
                <td colspan="2"><p><?php foreach($error as $loi){
                        echo $loi . "<br>";
                    }?></p></td>
            </tr>
            <tr><td><a href="?page=TNT-QLBS-Register">Register</a></td></tr>
        </table>
    </form>
    <p align="left"><a href="?page=">Quay lại</a></p>

</body>
</html>
<?php $this->end(); ?>