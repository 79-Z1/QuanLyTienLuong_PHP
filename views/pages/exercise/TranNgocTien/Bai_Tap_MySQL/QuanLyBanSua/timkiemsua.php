<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<title>Tim kiem sua</title>

</head>

<body>
	<?php 
		require('connect.php');

		$qr_LoaiSua ="select Ten_loai, Ma_loai_sua from loai_sua";
		$qr_HangSua ="select Ten_hang_sua, Ma_hang_sua from hang_sua";

		$loaiSua = mysqli_query($conn, $qr_LoaiSua);
		$hangSua = mysqli_query($conn, $qr_HangSua);

	?>
	<form action="" method="get">

		<table bgcolor="#eeeeee" align="center" width="70%" border="1" cellpadding="5" cellspacing="5" style="border-collapse: collapse;">

			<tr>

				<td colspan="4" align="center">
					<font color="blue">
						<h3>TÌM KIẾM THÔNG TIN SỮA</h3>
					</font>
				</td>

			</tr>
			<tr align="center">
				<td>Loại sữa</td>
				<td>
					<select name="loaisua" >
						<option value="">Trống</option>
						<?php 
							if (mysqli_num_rows($loaiSua) <> 0) {
								while ($row = mysqli_fetch_array($loaiSua, MYSQLI_ASSOC)) {
									echo "<option value='$row[Ma_loai_sua]'";
									if(isset($_GET['loaisua']) && $_GET['loaisua'] == $row['Ma_loai_sua']) echo "selected";
									echo ">$row[Ten_loai]</option>";
								}
							}
						?>
					</select>
				</td>
				<td>Hãng sữa</td>
				<td>
					<select name="hangsua" >
						<option value="" selected>Trống</option>
						<?php 
							if (mysqli_num_rows($hangSua) <> 0) {
								while ($row = mysqli_fetch_array($hangSua, MYSQLI_ASSOC)) {
									echo "<option value='$row[Ma_hang_sua]'";
									if(isset($_GET['hangsua']) && $_GET['hangsua'] == $row['Ma_hang_sua']) echo "selected";
									echo ">$row[Ten_hang_sua]</option>";
								}
							}
						?>
					</select>
				</td>
			</tr>
			<tr>

				<td colspan="4" align="center">Tên sữa: <input type="text" name="tensua" size="30" value="<?php if (isset($_GET['tensua'])) echo $_GET['tensua']; ?>">

					<input type="submit" name="tim" value="Tìm kiếm">
				</td>

			</tr>

		</table>

	</form>

	<?php

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$tensua = $_GET['tensua'];
		$ls = $_GET['loaisua'];
		$hs = $_GET['hangsua'];
		
		$timkiem = "Select *

			from sua, hang_sua, loai_sua

			WHERE sua.ma_hang_sua = hang_sua.ma_hang_sua
			and sua.ma_loai_sua = loai_sua.ma_loai_sua";

		if($tensua!=""){
			$timkiem .= " AND Ten_sua like '%$tensua%'";
		}
		if($hs!=""){
			$timkiem .= " AND hang_sua.Ma_hang_sua = '$hs'";
		}
		if($ls!=""){
			$timkiem .= " AND loai_sua.Ma_loai_sua = '$ls'";
		}	
		
		$resultTimKiem = mysqli_query($conn, $timkiem);

		if (mysqli_num_rows($resultTimKiem) <> 0) {
			$rows = mysqli_num_rows($resultTimKiem);

			echo "<div align='center'><b>Có $rows sản phẩm được tìm thấy.</b></div>";

			while ($row = mysqli_fetch_array($resultTimKiem, MYSQLI_ASSOC)) {

				echo '<table border="1" cellpadding="5" cellspacing="5" style="border-collapse:collapse;">

				<tr bgcolor="#eeeeee"><td colspan="2" align="center"><h3>' .

					$row['Ten_sua'] . ' - ' . $row['Ten_hang_sua'] . '</h3></td></tr>';

				echo '<tr><td width="200" align="center"><img src="Hinh_sua/' . $row['Hinh'] . '"/></td>';

				echo '<td><i><b>Thành phần dinh dưỡng:</i></b><br />' . $row['TP_Dinh_Duong'] . '<br />';

				echo '<i><b>Lợi ích:</b></i>' . $row['Loi_ich'] . '<br />';

				echo '<i><b>Trọng lượng: </b></i>' . $row['Trong_luong'] . ' gr - <i><b>Đơn giá: </b></i>' .

					$row['Don_gia'] . ' VNĐ';

				echo '</td></tr></table>';
			}
		} else echo "<div><b>Không tìm thấy sản phẩm này.</b></div>";
	}


?>

</body>

</html>