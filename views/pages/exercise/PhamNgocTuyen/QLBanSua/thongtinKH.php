<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Thông tin Khách Hàng</title>
    <style>
        tr:nth-child(odd){
            background-color: darksalmon;
        }
        th{
            color: blue;
        }
        img{
            width: 50px;
            height: 50px;

        }
        
    </style>
    
</head>
<body>

<?php

  // Ket noi CSDL
//require("connect.php");
$conn = mysqli_connect ('localhost', 'root', '', 'qlbansua') 
		OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
$sql = 'select * from khach_hang';
$result = mysqli_query($conn, $sql);




echo "<p align='center'><font size='5' color='blue'> THÔNG TIN KHÁCH HÀNG</font></P>";
 echo "<table align='center' width='700' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";
 echo '<tr>
    <th width="50">Mã KH</th>
    <th width="150">Tên Khách Hàng</th>
    <th width="50">Giới Tính</th>
    <th width="200">Địa Chỉ</th>
    <th width="100">Số Điện Thoại</th>
    <th width="100">Email</th>
    <th width="100"></th>
</tr>';

 if(mysqli_num_rows($result)<>0)
 {	 $stt=1;
	while($rows=mysqli_fetch_array($result))
	{          echo "<tr>";
		     echo "<td>$rows[Ma_khach_hang]</td>";
		     echo "<td>$rows[Ten_khach_hang]</td>";
          if($rows[2]==1){
             echo "<td> <img src='./GioiTinh/nu.jpg' alt=''></td>  ";
             }
             else{
                echo "<td> <img src='./GioiTinh/nam.jpg' alt=''></td>  ";
             }
		     echo "<td>$rows[Phai]</td>";  
             echo "<td>$rows[Dia_chi]</td>";  
             echo "<td>$rows[Email]</td>";  
             echo "<td><a href='edit_milk.php?Ma_khach_hang={$rows['Ma_khach_hang']}'><i style='color:blue' class='bi bi-pencil-square'></i>Sua</a></td>"; 
             echo "<td><a href='delete_kh.php?Ma_khach_hang={$rows['Ma_khach_hang']}'><i style='color:blue' class='bi bi-pencil-square'></i>Xoa</a></td>";  
		     echo "</tr>";
	             $stt+=1;
           
	}
       
 }
 
echo"</table>";

?>

</body>
</html>

<?php $this->end(); ?>