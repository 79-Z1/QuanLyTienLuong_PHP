<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Tim kiem thong tin khach hang</title>

</head>

<body>

<form action="" method="get">

<table bgcolor="#eeeeee" align="center" width="70%" border="1" 

	   cellpadding="5" cellspacing="5" style="border-collapse: collapse;">

<tr>

	<td align="center"><font color="blue"><h3>TÌM KIẾM THÔNG TIN KHÁCH HÀNG</h3></font></td>

</tr>

<tr>

	<td align="center">Tên khách hàng: <input type="text" name="tenkh" size="30" 

				value="<?php if(isset($_GET['tenkh'])) echo $_GET['tenkh'];?>">

</tr>
<tr>

	<td align="center">Mã khách hàng: <input type="text" name="makh" size="30" 

				value="<?php if(isset($_GET['makh'])) echo $_GET['makh'];?>">

</tr>
<tr>
    <td align="center"><input type="submit" name="tim" value="Tìm kiếm"></td></td>
</tr>

</table>

</form>

<?php 

if($_SERVER['REQUEST_METHOD']=='GET')

{

	// if(empty($_GET['tenkh'])) echo "<p align='center'>Vui lòng nhập tên khách hàng</p>";
    if(empty($_GET['makh'])) echo "<p align='center'>Vui lòng nhập mã khách hàng</p>";
	else

	{

		$tenkh=$_GET['tenkh'];	
        $makh =$_GET['makh'];

		require('connect.php');

		$query="Select Ten_khach_hang,Dia_chi,Dien_thoai,Email, hoa_don.*

		      from khach_hang,hoa_don

		      WHERE khach_hang.Ma_khach_hang = hoa_don.Ma_khach_hang

              AND khach_hang.Ma_khach_hang like '%$makh%' AND Ten_khach_hang like '%$tenkh%'";

		$result=mysqli_query($conn,$query);		

		if(mysqli_num_rows($result)<>0)

		{	$rows=mysqli_num_rows($result);

			echo "<div align='center'><b>Có $rows khách hàng được tìm thấy.</b></div>";

			while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))

			{
                echo '<table border="1" cellpadding="5" cellspacing="5" style="border-collapse:collapse;">

					<tr bgcolor="#eeeeee"><td colspan="2" align="center"><h3>'.$row['Ten_khach_hang'].' </h3></td></tr>';

				echo '<tr><td><b>Địa chỉ: </b> <br /> '.$row['Dia_chi'].'<br/>';

                echo '<b>Email: </b> <br /> '.$row['Email'].'<br/>';

                echo '<b>Số điện thoại: </b> <br /> '.$row['Dien_thoai'].'<br/></td>';
                echo '</tr></table>';

				echo '<table border="1" cellpadding="5" cellspacing="5" style="border-collapse:collapse;">

					<tr bgcolor="#eeeeee"><td colspan="2" align="center"><h3>'.$row['So_hoa_don'].' </h3></td></tr>';
                

                echo '<tr><td><b>Ngày hoá đơn: </b> <br /> '.$row['Ngay_HD'].'<br/>';

                echo '<b>Trị giá: </b> <br /> '.$row['Tri_gia'].'<br/>';

				echo '</td></tr></table>';

			}

		}

		else echo "<div><b>Không tìm thấy sản phẩm này.</b></div>";

	}

}

?>

</body>
</html>