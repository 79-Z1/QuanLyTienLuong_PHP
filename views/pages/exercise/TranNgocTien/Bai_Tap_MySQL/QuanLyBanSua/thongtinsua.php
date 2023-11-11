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

    // Ket noi CSDL

    //require("connect.php");

    $conn = mysqli_connect('localhost', 'root', '', 'qlbansua')

        or die('Could not connect to MySQL: ' . mysqli_connect_error());

    $rowsPerPage = 10;
    $sql = "select * from sua";
    $re = mysqli_query($conn, $sql);

    $numRows = mysqli_num_rows($re);
    $maxPage = floor($numRows / $rowsPerPage) + 1;

    $offset = ($_GET["trang"] - 1) * $rowsPerPage;
    
    $sql2 = "select Ma_sua,ten_sua,Trong_luong,Don_gia from sua Limit " . $offset . "," . $rowsPerPage . "";
    $result = mysqli_query($conn, $sql2);

    // $sql = 'select Ma_sua,ten_sua,Trong_luong,Don_gia from sua';

    // $result = mysqli_query($conn, $sql);
//     $rowsPerPage = 10; //số mẩu tin trên mỗi trang, giả sử là 10
//     if (!isset($_GET['page'])) {
//         $_GET['page'] = 1;
//     }
//     $re = mysqli_query($conn, 'select * from sua');
//     //tổng số mẩu tin cần hiển thị
//     $numRows = mysqli_num_rows($re);
//     //tổng số trang
//     $maxPage = floor($numRows / $rowsPerPage) + 1;
//     //vị trí của mẩu tin đầu tiên trên mỗi trang
//     $offset = ($_GET['page'] - 1) * $rowsPerPage;
//     //lấy $rowsPerPage mẩu tin, bắt đầu từ vị trí $offset
//     $result = mysqli_query($conn, 'SELECT Ma_sua, ten_sua, Trong_luong, 
// Don_gia FROM sua LIMIT ' . $offset . ', ' . $rowsPerPage);


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
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?trang=". 1 ."'>Đầu</a> ";
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?trang=". $_GET['trang'] - 1 . "'>Back</a> ";
        }
        for( $i = 1; $i <= $maxPage; $i++ ){
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?trang=$i" . "'>$i</a> ";
        }
        if($_GET['trang'] < 5){
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?trang=". $_GET['trang'] + 1 . "'>Next</a> ";
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?trang=". $maxPage ."'>Cuối</a> ";
        }

    // if ($_GET['page'] > 1){
    //     echo "<a href=" .$_SERVER['PHP_SELF']."?page=".(1).">Về đầu</a> ";
    //     echo "<a href=" .$_SERVER['PHP_SELF']."?page=".($_GET['page']-1).">Back</a> ";
    // }
    
    // for ($i = 1; $i <= $maxPage; $i++) {
    //     if ($i == $_GET['page']) {
    //         echo '<b>' . $i . '</b> '; //trang hiện tại sẽ được bôi đậm
    //     } else
    //         echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . $i . ">" . $i . "</a> ";
    // }
    // if ($_GET['page'] < $maxPage){
    //     echo "<a href=". $_SERVER['PHP_SELF']."?page=".($_GET['page']+1).">Next</a>";
    //     echo "<a href=" .$_SERVER['PHP_SELF']."?page=".($maxPage).">Về cuối</a> ";
    // }
    echo "</p>";
    echo '<p align="center"> Tong so trang la: ' . $maxPage . "</p>";

    ?>

</body>

</html>