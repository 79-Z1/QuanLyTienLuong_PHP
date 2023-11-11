<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Thông tin sữa</title>

</head>

<body>
    <?php
    require("connect.php");

    $rowsPerPage = 10; //số mẩu tin trên mỗi trang, giả sử là 10
    if (!isset($_GET['page'])) {
        $_GET['page'] = 1;
    }
    //vị trí của mẩu tin đầu tiên trên mỗi trang
    $offset = ($_GET['page'] - 1) * $rowsPerPage;
    //lấy $rowsPerPage mẩu tin, bắt đầu từ vị trí $offset
    $sql = 'SELECT Ma_sua, ten_sua, Trong_luong, Don_gia, Ten_hang_sua, Ten_loai, Hinh 
            FROM sua, hang_sua, loai_sua 
            where sua.Ma_hang_sua = hang_sua.Ma_hang_sua 
            and sua.Ma_loai_sua = loai_sua.Ma_loai_sua LIMIT ' . $offset . ', ' . $rowsPerPage;
    $result = mysqli_query($conn,$sql);

    // if (mysqli_num_rows($result) <> 0) {
    //     echo "<tr>";
    //     while ($rows = mysqli_fetch_array($result)) {
    //         echo "<td align='center'>";
    //         echo "<b>$rows[ten_sua]</b><br>";
    //         echo "$rows[Trong_luong] gr - $rows[Don_gia]";
    //         echo "<img width='100' src='Hinh_sua/$rows[Hinh]'>";
    //         echo "</td>";
    //     }
    //     echo "</tr>";
    // }
    
    if (mysqli_num_rows($result) <> 0) {
        $i=0;
        $j=0;
        while ($rows = mysqli_fetch_array($result)) {
            $sua[$i][$j] = $rows;
            if($j==4){
                $i++;
                $j=-1;
            } 
            $j++;
            
        }
    }
    echo "<p align='center'><font size='5' color='blue'> THÔNG TIN CÁC SẢN PHẨM</font></P>";

    echo "<table align='center' width='700' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";
    foreach($sua as $hang){
        echo "<tr>";
        foreach($hang as $sanPham){
            echo "<td align='center'>";
            echo "<a href='chitietsua.php?MaSua=$sanPham[Ma_sua]'><b>$sanPham[ten_sua]</b></a><br>";
            echo "$sanPham[Trong_luong] gr -" . $sanPham['Don_gia'] ."";
            echo "<img width='100' src='Hinh_sua/$sanPham[Hinh]'>";
            echo "</td>";
        }
        echo "</tr>";
    }
    
    echo "</table>";

    $re = mysqli_query($conn, 'select * from sua');
    //tổng số mẩu tin cần hiển thị
    $numRows = mysqli_num_rows($re);
    //tổng số trang
    $maxPage = floor($numRows / $rowsPerPage) + 1;
    echo '<p align="center">';
    if ($_GET['page'] > 1){
        echo "<a href=" .$_SERVER['PHP_SELF']."?page=".(1).">Về đầu</a> ";
        echo "<a href=" .$_SERVER['PHP_SELF']."?page=".($_GET['page']-1).">Back</a> ";
    }
    
    for ($i = 1; $i <= $maxPage; $i++) {
        if ($i == $_GET['page']) {
            echo '<b>' . $i . '</b> '; //trang hiện tại sẽ được bôi đậm
        } else
            echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . $i . ">" . $i . "</a> ";
    }
    if ($_GET['page'] < $maxPage){
        echo "<a href=". $_SERVER['PHP_SELF']."?page=".($_GET['page']+1).">Next</a>";
        echo "<a href=" .$_SERVER['PHP_SELF']."?page=".($maxPage).">Về cuối</a> ";
    }
    echo "</p>";
    echo '<p align="center"> Tong so trang la: ' . $maxPage . "</p>";

    ?>

</body>

</html>