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
    require('connect.php');
    if(isset($_POST['register'])){
        if(empty($_POST['uname']))
            echo "Vui lòng nhập vào username";
            else if(empty($_POST['psw'])){
                echo "Vui lòng nhập vào password";
            }
            else if(empty($_POST['psw2'])){
                echo "Vui lòng nhập vào repeat password";
            }
            else{
                $username = trim($_POST['uname']);
                $password =trim($_POST['psw']);
                $password2 = trim ($_POST['psw2']);
            }
            if($password == $password2){
                $listusername = "select * from users where user_name = '$username'";
                $checkusername = mysqli_query($conn,$listusername);
                if(mysqli_num_rows($checkusername) <> 0)
                    echo "username đã có người sử dụng";
                else{
                    $sql = "insert into users(user_name,password) values('$username','$password')";
                    $result = mysqli_query($conn,$sql);	
                    header('Location: loginqlbs.php');
                }
            }
    }

?>
<body>
<form method="post">
  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" value="<?php echo $username?>">

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw">
    
    <label for="psw2"><b>Repeat Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw2">

    <input type="submit" value="Register" name="register"/>
  </div>
</form>
</body>
</html>