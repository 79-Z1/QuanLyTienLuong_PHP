<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Thông tin sữa</title>
    <style>
        .wrapper {
            display: block;
            max-width: 1200px;
            margin: 0 auto;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            margin-left: -12px;
            margin-right: -12px;
        }

        .item {
            flex: 0 0 16.66667%;
            max-width: 16.66667%;
            margin: 0 5px 10px 5px;
            border: 1px solid #000;
        }
        p {
            margin: 5px 0;
        }
        img {
            width: 100px;
        }
    </style>
</head>
<?php
// Ket noi CSDL
require("../connect.php");
$rowsPerPage = 10; //số mẩu tin trên mỗi trang, giả sử là 10
if (!isset($_GET['page'])) {
    $_GET['page'] = 1;
}
//vị trí của mẩu tin đầu tiên trên mỗi trang
$offset = ($_GET['page'] - 1) * $rowsPerPage;
/*
 1: 0 * 5 = 0
 2: 1 * 5 = 5
 3: 2 * 5 = 10
*/
//lấy $rowsPerPage mẩu tin, bắt đầu từ vị trí $offset
$sql = "SELECT * FROM sua LIMIT $offset,$rowsPerPage";
$result = mysqli_query($conn, $sql);
$ds_sua = [];
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $ds_sua[] = array(
        'Ma_sua' => $row['Ma_sua'],
        'Ten_sua' => $row['Ten_sua'],
        'Ma_hang_sua' => $row['Ma_hang_sua'],
        'Ma_loai_sua' => $row['Ma_loai_sua'],
        'Trong_luong' => $row['Trong_luong'],
        'Don_gia' => $row['Don_gia'],
        'TP_Dinh_Duong' => $row['TP_Dinh_Duong'],
        'Loi_ich' => $row['Loi_ich'],
        'Hinh' => $row['Hinh'],
    );
}
?>

<body>
    <h1 align="center" style="background-color: blueviolet;">THÔNG TIN CÁC SẢN PHẨM</h1>
    <div class="wrapper">
        <div class="container">
            <?php foreach ($ds_sua as $sua) : ?>
                <div class="item" align="center">
                    <a href="./chitietsua.php?masua=<?= $sua['Ma_sua'] ?>"><?= $sua['Ten_sua'] ?></a>
                    <p><?= $sua['Trong_luong'] ." - ". $sua['Don_gia'] ?></p>
                    <img src="../Hinh_sua/<?= $sua['Hinh'] ?>" alt="">
                </div>
            <?php endforeach; ?>
        </div>
        <?php
            $re = mysqli_query($conn, 'select * from sua');
            //tổng số mẩu tin cần hiển thị
            $numRows = mysqli_num_rows($re);
            //tổng số trang
            $maxPage = ceil($numRows / $rowsPerPage);
            
            echo "<div align='center'>";
            echo "<a href=" .$_SERVER['PHP_SELF']."?page=1 >tới trang đầu</a> ";
            //gắn thêm nút Back
            if ($_GET['page'] > 1)
            echo "<a href=" .$_SERVER['PHP_SELF']."?page=".($_GET['page']-1)."><</a> ";
            //tạo link tương ứng tới các trang
            for ($i = 1; $i <= $maxPage; $i++) {
                if ($i == $_GET['page']) {
                    echo  $i. ' '; //trang hiện tại sẽ được bôi đậm
                } else
                    echo "<a href=". $_SERVER['PHP_SELF']. "?page=". $i . ">". $i ."</a> ";
            }
            //gắn thêm nút Next
            if ($_GET['page'] < $maxPage)
            echo "<a href=". $_SERVER['PHP_SELF']."?page=".($_GET['page']+1).">></a>";
            echo "<a href=" .$_SERVER['PHP_SELF']."?page=".($maxPage).">Tới trang cuối</a> ";
            echo "</div>";
        ?>
    </div>
</body>

</html>