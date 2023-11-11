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

    if(!isset($_GET["trang"])){
        $_GET["trang"] = 1;
    }

    require("connect_qlbs.php");


    $rowsPerPage = 10;
    $sql = "select * from sua";
    $re = mysqli_query($conn, $sql);

    $numRows = mysqli_num_rows($re);
    $maxPage = floor($numRows / $rowsPerPage) + 1;

    $offset = ($_GET["trang"] - 1) * $rowsPerPage;
    
    $sql2 = "select Ma_sua,ten_sua,Trong_luong,Don_gia from sua Limit " . $offset . "," . $rowsPerPage . "";
    $result = mysqli_query($conn, $sql2);



    echo "<p align='center'><font size='5' color='blue'> THÔNG TIN SỮA</font></P>";

    echo "<table align='center' width='700' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";

    echo '<tr>

    <th width="50">STT</th>

     <th width="50">Mã sữa</th>

    <th width="150">Tên sữa</th>

    <th width="200">Trọng lượng</th>

    <th width="200">Đơn giá</th>

</tr>';



    if (mysqli_num_rows($result) <> 0) {
        $stt = 1;

        while ($rows = mysqli_fetch_row($result)) {
            if ($stt % 2 == 0) $bg = "#DCDCDC";
            else $bg = "white";
            echo "<tr style='background-color: $bg'>";

            echo "<td>$stt</td>";

            echo "<td>$rows[0]</td>";

            echo "<td width='300' >$rows[1]</td>";

            echo "<td>$rows[2]</td>";
            echo "<td>$rows[3]</td>";

            echo "</tr>";

            $stt += 1;
        }
    }

    echo "</table>";

    
    echo '<p align="center">';
        if($_GET['trang'] > 1){
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=TNT-QLBS-List-Sua&trang=". 1 ."'>Đầu</a> ";
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=TNT-QLBS-List-Sua&trang=". $_GET['trang'] - 1 . "'>Back</a> ";
        }
        for( $i = 1; $i <= $maxPage; $i++ ){
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=TNT-QLBS-List-Sua&trang=$i" . "'>$i</a> ";
        }
        if($_GET['trang'] < 5){
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=TNT-QLBS-List-Sua&trang=". $_GET['trang'] + 1 . "'>Next</a> ";
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=TNT-QLBS-List-Sua&trang=". $maxPage ."'>Cuối</a> ";
        }

    echo "</p>";
    echo '<p align="center"> Tong so trang la: ' . $maxPage . "</p>";

    ?>
    <p align="left"><a href="?page=">Quay lại</a></p>

</body>

</html>
<?php $this->end(); ?>