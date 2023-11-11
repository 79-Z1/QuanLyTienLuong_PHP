<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Tim kiem Khach Hang</title>

</head>

<body>

<form action="" method="get">

<table bgcolor="#eeeeee" align="center" width="70%" border="1" 

	   cellpadding="5" cellspacing="5" style="border-collapse: collapse;">

<tr>

	<td align="center"><font color="blue"><h3>TÌM KIẾM THÔNG TIN KHÁCH HÀNG</h3></font></td>

</tr>

<tr>

	<td align="center">Tên Khách hàng: <input type="text" name="tenkh" size="30" 

				value="<?php if(isset($_GET['tenkh'])) echo $_GET['tenkh'];?>">

			<input type="submit" name="tim" value="Tìm kiếm"></td>

</tr>

</table>

</form>

<?php 

if($_SERVER['REQUEST_METHOD']=='GET')

{

	if(empty($_GET['tenkh'])) echo "<p align='center'>Vui lòng nhập tên khách</p>";

	else

	{

		$tenkh=$_GET['tenkh'];	

		require('connect.php');

		$query="Select khach_hang.*
		      from hoa_don, khach_hang

		      WHERE Ten_khach_hang like '$tenkh'";  

		$result=mysqli_query($conn,$query);		

		if(mysqli_num_rows($result)<>0)

		{	$rows=mysqli_num_rows($result);

			echo "<div align='center'><b>Có $rows sản phẩm được tìm thấy.</b></div>";

			while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))

			{

				echo '<table border="1" cellpadding="5" cellspacing="5" style="border-collapse:collapse;">

					<tr bgcolor="#eeeeee"><td colspan="2" align="center"><h3>'.

						$row['Ten_khach_hang'].'</h3></td></tr>';

				//echo '<tr><td width="200" align="center"><img src="Hinh_sua/'.$row['Hinh'].'"/></td>';
				// echo '<td><i><b>Thành phần dinh dưỡng:</i></b><br />'.$row['Ma_khach_hang'].'<br />';
				echo '<td><i><b>Thành phần dinh dưỡng:</i></b><br />'.$row['Ten_khach_hang'].'<br />';
				// echo '<i><b>Lợi ích:</b></i>'.$row['Dia_chi'].'<br />';
				// echo '<i><b>Trọng lượng: </b></i>'.$row['Trong_luong'].' gr - <i><b>Đơn giá: </b></i>'.
				// 		$row['Don_gia'].' VNĐ';
				// echo '</td></tr></table>';

			}

		}

		else echo "<div><b>Không tìm thấy sản phẩm này.</b></div>";

	}

}

?>

</body>

</html>