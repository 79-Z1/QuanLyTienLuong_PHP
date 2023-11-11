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

                <td colspan="3" align="center">
                    <font color="blue">
                        <h3>TÌM KIẾM THÔNG TIN KHÁCH HÀNG</h3>
                    </font>
                </td>

            </tr>

            <tr>

                <td align="center">Tên khách hàng: <input type="text" name="tenKH" size="30" value="<?php if (isset($_GET['tenKH'])) echo $_GET['tenKH']; ?>">

                </td>
                <td rowspan="2" align="center"><input type="submit" name="tim" value="Tìm kiếm"></td>

            </tr>
            <tr>
                <td align="center">Mã khách hàng: <input type="text" name="maKH" size="30" value="<?php if (isset($_GET['maKH'])) echo $_GET['maKH']; ?>">

                </td>
            </tr>

        </table>

    </form>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        if (empty($_GET['tenKH']) && empty($_GET['maKH'])) {
            // echo "<p align='center'>Vui lòng nhập tên khách hàng hoặc mã khách hàng</p>";
            $tenKH = "";
            $maKH = "";
        }
        else {

            $tenKH = $_GET['tenKH'];
            $maKH = $_GET['maKH'];

            require('connect.php');

            $query = "Select khach_hang.*
		      from khach_hang
                    where Ten_khach_hang like '%$tenKH%' and khach_hang.Ma_khach_hang like '%$maKH%'";

            $query2 = "Select hoa_don.*
            from hoa_don
                    where Ma_khach_hang like '%$maKH%'";
            $result = mysqli_query($conn, $query);
            $result2 = mysqli_query($conn, $query2);
            if (mysqli_num_rows($result) <> 0) {
                $rows = mysqli_num_rows($result);

                echo "<div align='center'><b>Có $rows khách hàng được tìm thấy.</b></div>";

                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                    echo '<table border="1" cellpadding="5" cellspacing="5" style="border-collapse:collapse;">

					<tr bgcolor="#eeeeee"><td colspan="2" align="center">Mã khách hàng: ' .

                        $row['Ma_khach_hang'] . ' - Tên khách hàng: ' . $row['Ten_khach_hang'] . ' - Giới tính: ' . $row['Phai'] . '</td></tr>';

                    echo '<tr><td align="center">Địa chỉ: ' . $row['Dia_chi'] . ' - Email: ' . $row['Email'] . '</td>';

                    echo '</td></tr></table>';
                }
            } else echo "<div><b>Không tìm thấy khách hàng này.</b></div>";
            if (mysqli_num_rows($result2) <> 0) {
                $rows2 = mysqli_num_rows($result2);
                echo "<div align='center'><b>Có $rows2 hóa đơn được tìm thấy.</b></div>";
                echo '<br><table border="1" cellpadding="5" cellspacing="5" style="border-collapse:collapse;">';
                echo '<thead>
                        <td>Số hóa đơn</td>
                        <td>Mã khách hàng</td>
                        <td>Ngày HD</td>
                        <td>Trị Giá</td>
                    </thead>';
                while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {

                    
				echo	'<tr>
                        <td>'.$row2['So_hoa_don'].'</td>
                        <td>'.$row2['Ma_khach_hang'].'</td>
                        <td>'.$row2['Ngay_HD'].'</td>
                        <td>'.$row2['Tri_gia'].'</td>
                    </tr>';

        

                }
                echo '</table>';
            }
        }
    }
    
    ?>
</body>

</html>