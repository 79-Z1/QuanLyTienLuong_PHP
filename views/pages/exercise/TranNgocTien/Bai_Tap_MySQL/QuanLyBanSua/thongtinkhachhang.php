<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Thông tin khách hàng</title>

</head>

<body>

<?php

 

  // Ket noi CSDL

  require("connect.php");

// $conn = mysqli_connect ('localhost', 'root', '', 'qlbansua') 

// 		OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

$sql = 'select * from khach_hang';

$result = mysqli_query($conn, $sql);



echo "<p align='center'><font size='5' color='blue'> THÔNG TIN KHÁCH HÀNG</font></P>";

 echo "<table align='center'  border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";

 echo '<tr>
    <th>STT</th>
    <th>Mã KH</th>

    <th >Tên khách hàng</th>

    <th>Giới tính</th>

    <th>Địa chỉ</th>
    <th>Số điện thoại</th>
    <th>Email</th>
    <th></th>
    <th></th>


</tr>';



 if(mysqli_num_rows($result)<>0)

 {	 $stt=1;

	while($rows=mysqli_fetch_array($result))
	{   
        if($stt%2!=0) $bg = "#DCDCDC";
        else $bg ="white";
        echo "<tr style='background-color: $bg'>";
        echo "<td>$stt</td>";
        echo "<td>$rows[Ma_khach_hang]</td>";
        echo "<td>$rows[Ten_khach_hang]</td>";
        echo $rows['Phai'] == 0 ? "<td align='center'><img width='30' src='Avatar/nam.jpg'></td>" : "<td align='center'><img width='30' src='Avatar/nu.jpg'></td>";
        echo "<td>$rows[Dia_chi]</td>";
        echo "<td>$rows[Dien_thoai]</td>";
        echo "<td>$rows[Email]</td>";
        echo "<td><a href='edit_kh.php?maKH=$rows[Ma_khach_hang]'>Sửa</a></td>";
        echo "<td><a href='xoakhachhang.php?maKH=$rows[Ma_khach_hang]'>Xóa</a></td>";
		    echo "</tr>";
	    $stt+=1;
	}

 }

echo"</table>";

?>

<a href="javascript:window.history.back(-1);">Logout</a>
</body>

</html>