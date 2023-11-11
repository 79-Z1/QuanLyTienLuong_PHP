<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Thông tin sữa</title>
</head>
<style>
    .wrapper{
        width: 1200px;
        display: block;
        margin: 0 auto;
    }
    .container{
        display: flex;
        flex-wrap: wrap;
        margin-left: -12px;
        margin-right: -12px;
    }
    .item{
        flex: 0 0 16.66667%;
        max-width: 16.66667%;
        border: 1px solid #000;
    }
    img{
        width: 100px;
    }
</style>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'QLBanSua');
mysqli_set_charset($conn, 'UTF8');
$rowsPerPage = 10; //số mẩu tin trên mỗi trang, giả sử là 10
if (!isset($_GET['page'])) {
    $_GET['page'] = 1;
}
$re = mysqli_query($conn, 'select * from sua');
//tổng số mẩu tin cần hiển thị
$numRows = mysqli_num_rows($re);
//tổng số trang
$maxPage = floor($numRows / $rowsPerPage) + 1;
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
//vị trí của mẩu tin đầu tiên trên mỗi trang
$offset = ($_GET['page'] - 1) * $rowsPerPage;
//lấy $rowsPerPage mẩu tin, bắt đầu từ vị trí $offset
$result = mysqli_query($conn, "SELECT Ma_sua, ten_sua, Trong_luong, Don_gia FROM sua LIMIT $offset,$rowsPerPage");
  // Ket noi CSDL
require("connect.php");
$conn = mysqli_connect ('localhost', 'root', '', 'qlbansua') 
		OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
        $sql = 'select * from sua';
        $result = mysqli_query($conn, $sql);

$ds_sua=[];
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $ds_sua[]=array(
        'Ma_sua' => $row['Ma_sua'],
        'Ten_sua' => $row['Ten_sua'],
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
                    <p><?= $sua['Trong_luong'] . " - " . $sua['Don_gia'] ?></p>
                    <img src="./Hinh_sua/<?= $sua['Hinh'] ?>" alt="">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

<?php


?>

</body>
</html>