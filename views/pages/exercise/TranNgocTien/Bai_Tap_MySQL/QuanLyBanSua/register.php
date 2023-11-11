<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<?php 
    require("connect.php");
    if(isset($_POST['username']))
        $username = trim($_POST['username']);
    else $username="";

    if(isset($_POST['pass']))
        $pass = trim($_POST['pass']);
    else $pass="";

    if(isset($_POST['repass']))
        $repass = trim($_POST['repass']);
    else $repass="";

    $error = array();
    function CheckUserName($username, $conn){
        $sql = 'select user_name, password from user';
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) <> 0) {
                while ($rows = mysqli_fetch_array($result)) {
                    if($username == $rows['user_name']){
                       return false;
                    }
                }
            }
        return true;
    }
    if(isset($_POST['register'])){
        if(!CheckUserName($username, $conn)){
            $error[]="Username đã có người sử dụng";
        }
        if(CheckUserName($username,$conn) && $username!="" && $pass!="" && $repass!="" && $repass == $pass ){
            
            $sql = "insert into user(user_name, password) values('$username','$pass')";
            $result = mysqli_query($conn, $sql);
            $error[]="Đăng kí thành công!";

        }
        if($username==""){
            $error[]="Vui lòng nhập Username";
        }
        if($pass==""){
            $error[]="Vui lòng nhập Password";
        }
        if($repass==""){
            $error[]="Vui lòng nhập Re_Password";
        }
        if($repass!=$pass){
            $error[]="Nhập lại mật khẩu không chính xác";
        }


    }
?>

<body>
    <form action="" method="post">
        <table>
            <tr align="center">
                <td colspan="2"><b><h2>Register</h2></b></td>
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
                <td>Re-Enter the password</td>
                <td><input type="password" name="repass" value="<?php echo $repass;?>"></td>
            </tr>
            <tr align="center">
                <td colspan="2"><input type="submit" name="register" value="Register"></td>
            </tr>
            <tr>
                <td colspan="2"><p><?php foreach($error as $loi){
                        echo $loi . "<br>";
                    }?></p></td>
            </tr>
            <tr><td><a href="login.php">Login</a></td></tr>
        </table>
    </form>
</body>
</html>