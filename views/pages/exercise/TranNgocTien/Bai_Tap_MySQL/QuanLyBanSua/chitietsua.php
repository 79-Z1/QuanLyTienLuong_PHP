<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Chi tiết sữa</title>

</head>

<body>
    <?php 
        require("connect.php");
        $sql = "select sua.*, Ten_hang_sua  from sua, hang_sua where sua.Ma_hang_sua=hang_sua.Ma_hang_sua and Ma_sua = '$_GET[MaSua]'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)<>0){
            while($rows=mysqli_fetch_array($result)){   
                echo "
                <table align='center' border='1' width='600'>
                    <tr align='center'>
                        <td colspan='2'>$rows[Ten_sua] - $rows[Ten_hang_sua]</td>
                    </tr>
                    <tr>
                        <td>
                            <img src='Hinh_sua/$rows[Hinh]'>
                        </td>
                        <td>
                            <i><b>Thành phần dinh dưỡng:</b></i>
                            <p>$rows[TP_Dinh_Duong]</p>
                            <i><b>Lợi ích:</b></i>
                            <p>$rows[Loi_ich]</p>
                            <p align='end'><i><b>Trọng lượng: </b></i>$rows[Trong_luong]<i><b> - Đơn giá: </b></i>$rows[Don_gia]</p>
                        </td>
                    </tr>
                    <tr>
                        <td><a href='javascript:window.history.back(-1);'>Quay về</a></td>
                    </tr>
                </table>
                ";
            }
        }
	
    ?>

</body>