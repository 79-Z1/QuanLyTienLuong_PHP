<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Tim kiem sua</title>

</head>

<body>

<form action="" method="get">

<table bgcolor="#eeeeee" align="center" width="70%" border="1" 

	   cellpadding="5" cellspacing="5" style="border-collapse: collapse;">

<tr>

	<td align="center"><font color="blue"><h3>TÌM KIẾM THÔNG TIN SỮA</h3></font></td>

</tr>

<tr>

	<td align="center">Tên sữa: <input type="text" name="tensua" size="30" 

				value="<?php if(isset($_GET['tensua'])) echo $_GET['tensua'];?>">

			<input type="submit" name="tim" value="Tìm kiếm"></td>

</tr>

</table>

</form>

<?php 

if($_SERVER['REQUEST_METHOD']=='GET')

{

	if(empty($_GET['tensua'])) echo "<p align='center'>Vui lòng nhập tên sản phẩm</p>";

	else

	{

		$tensua=$_GET['tensua'];	

		require('connect.php');

		$query="Select sua.*, Ten_hang_sua 

		      from Sua,hang_sua 

		      WHERE sua.ma_hang_sua=hang_sua.ma_hang_sua

					AND Ten_sua like '%$tensua%'";

		$result=mysqli_query($conn,$query);		

		if(mysqli_num_rows($result)<>0)

		{	$rows=mysqli_num_rows($result);

			echo "<div align='center'><b>Có $rows sản phẩm được tìm thấy.</b></div>";

			while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))

			{

				echo '<table border="1" cellpadding="5" cellspacing="5" style="border-collapse:collapse;">

					<tr bgcolor="#eeeeee"><td colspan="2" align="center"><h3>'.

						$row['Ten_sua'].' - '.$row['Ten_hang_sua'].'</h3></td></tr>';

				echo '<tr><td width="200" align="center"><img src="Hinh_sua/'.$row['Hinh'].'"/></td>';

				echo '<td><i><b>Thành phần dinh dưỡng:</i></b><br />'.$row['TP_Dinh_Duong'].'<br />';

				echo '<i><b>Lợi ích:</b></i>'.$row['Loi_ich'].'<br />';

				echo '<i><b>Trọng lượng: </b></i>'.$row['Trong_luong'].' gr - <i><b>Đơn giá: </b></i>'.

						$row['Don_gia'].' VNĐ';

				echo '</td></tr></table>';

			}

		}

		else echo "<div><b>Không tìm thấy sản phẩm này.</b></div>";

	}

}

?>

</body>

</html>