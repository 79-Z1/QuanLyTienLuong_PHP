<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
</head>
<?php
    if(isset($_POST['name'])) 
            $name=trim($_POST['name']); 
        else $name="";
        if(isset($_POST['pass'])) 
            $pass=trim($_POST['pass']); 
        else $pass="";
       if(isset($_POST["tinh"])){
        require("connect.php");
        $conn = mysqli_connect ('localhost', 'root', '', 'qlBanSua') 
		OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
        $sql = 'select user_name,password from user';
        $result = mysqli_query($conn, $sql);
        echo "<p align='center'><font size='5' color='blue'> THÔNG TIN SỮA</font></P>";
        echo "<table align='center' width='2    00' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";
        echo '<tr>
            <th width="50">Tai Khoan</th>
           <th width="150">Mat Khau</th>
       </tr>';
       
        if(mysqli_num_rows($result)<>0)
        {	 $stt=1;
           while($rows=mysqli_fetch_row($result))
           {         
                if($name == $rows[0] && $pass == $rows[1]){
                    echo "Đã đang nhập thành công";
                    header('Location:thongtinSua.php');
                    break;  
                }
           }
        }
       echo"</table>";
       }
        //ket noi csdl      
        
?>
<body>
    <form action="" method="post">
        <table>
            <tr>
                <td>Tên tài khoản: </td>
                <td><input type="text" name="name"  value="<?php  echo $name;?>"/> </td>
            </tr>
            <tr>
                <td >Mật khẩu: </td>
                <td><input type="text" name="pass" value="<?php  echo $pass;?> "/></td>
            </tr>
            <tr>
                <td   colspan="4" align="center"><input type="submit" value="Đăng nhập" name="tinh" /></td>
            </tr>
        </table>
    </form>
</body>
</html>
</body>
</html>
<?php $this->end(); ?>