<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
form {
  border: 3px solid #f1f1f1;
}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}
button:hover {
  opacity: 0.8;
}
.container {
  padding: 16px;
}
</style>
<?php 
    if(isset($_POST['login'])){
        if(empty($_POST['uname']))
            echo "Vui lòng nhập vào username";
            else if(empty($_POST['psw'])){
                $username = trim($_POST['uname']);
                echo "Vui lòng nhập vào password";
            }  
            else{
                require('connect.php');
                $username = trim($_POST['uname']);
                $password =trim($_POST['psw']);
                $sql = "select * from users where user_name = '$username' and password = '$password'";
                $result = mysqli_query($conn,$sql);	
                if(mysqli_num_rows($result) <> 0){
                    header('Location: thongtinkhachhang.php');
                }
            }
    }
    if(isset($_POST['register'])){
        header('Location: register.php');
    }

?>
<body>
<form method="post">
  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" value="<?php echo $username?>">

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw">

    <input type="submit" value="Login" name="login"/>
    <input type="submit" value="Register" name="register"/>
  </div>
</form>
</body>
</html>