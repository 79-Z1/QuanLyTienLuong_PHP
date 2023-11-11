<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Thông tin sữa</title>
</head>
<body>
<?php

  // Ket noi CSDL
//require("connect.php");
$conn = mysqli_connect ('localhost', 'root', '', 'qlbansua') 
		OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
$sql = 'select Ma_sua,ten_sua,Trong_luong,Don_gia from sua';
$result = mysqli_query($conn, $sql);

echo "<p align='center'><font size='5' color='blue'> THÔNG TIN SỮA</font></P>";
 echo "<table align='center' width='700' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";
 echo '<tr>
    <th width="50">STT</th>
     <th width="50">Mã sữa</th>
    <th width="150">Tên sữa</th>
    <th width="200">Trọng lượng</th>
    <th width="200">Đơn gía</th>
</tr>';

 if(mysqli_num_rows($result)<>0)
 {	 $stt=1;
	while($rows=mysqli_fetch_row($result))
	{          echo "<tr>";
		     echo "<td>$stt</td>";	
		     echo "<td>$rows[0]</td>";
		     echo "<td>$rows[1]</td>";
		     echo "<td>$rows[2]</td>";
             echo "<td>$rows[3]</td>";
		     echo "</tr>";
	             $stt+=1;
	}
 }
echo"</table>";
?>
</body>
</html>

<?php $this->end(); ?>