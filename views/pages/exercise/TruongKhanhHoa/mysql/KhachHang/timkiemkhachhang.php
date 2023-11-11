<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Tim kiem sua</title>
</head>
<body>
    <form action="" method="get">
        <table bgcolor="#eeeeee" align="center" width="70%" border="1" cellpadding="5" cellspacing="5" style="border-collapse: collapse;">
            <tr>
                <td align="center">
                    <font color="blue">
                        <h3>TÌM KIẾM THÔNG TIN KHÁCH HÀNG</h3>
                    </font>
                </td>
            </tr>
            <tr>
                <td align="center">Mã khách hàng: <input type="text" name="makhachhang" size="30" value="<?php if (isset($_GET['makhachhang'])) echo $_GET['makhachhang']; ?>">
                    <input type="submit" name="tim" value="Tìm kiếm">
                </td>
            </tr>
        </table>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (empty($_GET['makhachhang'])) echo "<p align='center'>Vui lòng nhập mã khách hàng</p>";
        else {
            $makhachhang = $_GET['makhachhang'];
            require('connect.php');
            $query = "Select khach_hang.*, So_hoa_don, Tri_gia, Ngay_HD
		      from khach_hang,hoa_don
		      WHERE khach_hang.Ma_khach_hang=hoa_don.Ma_khach_hang
				AND khach_hang.Ma_khach_hang like '%$makhachhang%'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) <> 0) {
                $rows = mysqli_num_rows($result);
                echo "<div align='center'><b>Có $rows khách hàng được tìm thấy.</b></div>";
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo '<table border="1" cellpadding="5" cellspacing="5" style="border-collapse:collapse;">
					<tr bgcolor="#eeeeee"><td colspan="2" align="center"><h3>' .
                        $row['Ten_khach_hang'] . ' - ' . $row['Ma_khach_hang'] . '</h3></td></tr>';
                    echo '<td><i><b>Giới tính:</i></b>' . ($row['Phai'] == 1? ' Nữ' : ' Nam') . '<br />';
                    echo '<i><b>Địa chỉ:</i></b><br />' . $row['Dia_chi'] . '<br />';
                    echo '<i><b>Điện thoại:</b></i>' . $row['Dien_thoai'] . '<br />';
                    echo '<i><b>Email:</b></i>' . $row['Email'] . '<br />';
                    echo '</td></table>';
                    echo '<table border="1" cellpadding="5" cellspacing="5" style="border-collapse:collapse;">
					<th bgcolor="#eeeeee" colspan="3"><h3>Danh sách hóa đơn của khách hàng</h3></th>';
                    echo '<tr><td><i><b>Số hóa đơn:</i></b>' . $row['So_hoa_don'] . '</td>';
                    echo '<td><i><b>Ngày hóa đơn:</i></b><br />' . $row['Ngay_HD'] . '</td>';
                    echo '<td><i><b>Trị giá:</i></b><br />' . $row['Tri_gia'] . '</td>';
                    echo '</tr></table>';
                    
                }
            } else echo "<div><b>Không tìm thấy sản phẩm này.</b></div>";
        }
    }
    ?>
</body>

</html>