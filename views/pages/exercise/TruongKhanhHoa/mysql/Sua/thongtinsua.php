<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
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
<?php
// Ket noi CSDL
$conn = mysqli_connect('localhost', 'root', '', 'qlbansua')
    or die('Could not connect to MySQL: ' . mysqli_connect_error());
$rowsPerPage = 5; //số mẩu tin trên mỗi trang, giả sử là 10
if (!isset($_GET['p'])) {
    $_GET['p'] = 1;
}
//vị trí của mẩu tin đầu tiên trên mỗi trang
$offset = ($_GET['p'] - 1) * $rowsPerPage;
//lấy $rowsPerPage mẩu tin, bắt đầu từ vị trí $offset
$result = mysqli_query($conn, "SELECT * FROM sua LIMIT $offset,$rowsPerPage");
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
<h1 align="center" style="background-color: blueviolet;">THÔNG TIN CÁC SẢN PHẨM</h1>
<div class="wrapper">
    <div class="container">
        <?php foreach ($ds_sua as $sua) : ?>
            <div class="item" align="center">
                <a href="index.php?page=TKH-mysql-chitietsua&masua=<?= $sua['Ma_sua'] ?>"><?= $sua['Ten_sua'] ?></a>
                <p><?= $sua['Trong_luong'] . " - " . $sua['Don_gia'] ?></p>
                <img src="Hinh_sua/<?= $sua['Hinh'] ?>" alt="">
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php 
    $re = mysqli_query($conn, 'select * from sua');
    //tổng số mẩu tin cần hiển thị
    $numRows = mysqli_num_rows($re);
    //tổng số trang
    $maxPage = floor($numRows / $rowsPerPage) + 1;
    
    echo "<div align='center'>";
    echo "<a href=" .$_SERVER['PHP_SELF']."?page=TKH-mysql-ttsua&p=1 >tới trang đầu</a> ";
    //gắn thêm nút Back
    if ($_GET['p'] > 1)
    echo "<a href=" .$_SERVER['PHP_SELF']."?page=TKH-mysql-ttsua&p=".($_GET['p']-1)."><</a> ";
    //tạo link tương ứng tới các trang
    for ($i = 1; $i <= $maxPage; $i++) {
        if ($i == $_GET['p']) {
            echo  $i. ' '; //trang hiện tại sẽ được bôi đậm
        } else
            echo "<a href=". $_SERVER['PHP_SELF']. "?page=TKH-mysql-ttsua&p=". $i . ">". $i ."</a> ";
    }
    //gắn thêm nút Next
    if ($_GET['p'] < $maxPage)
    echo "<a href=". $_SERVER['PHP_SELF']."?page=TKH-mysql-ttsua&p=".($_GET['p']+1).">></a>";
    echo "<a href=" .$_SERVER['PHP_SELF']."?page=TKH-mysql-ttsua&p=".($maxPage).">Tới trang cuối</a> ";
    echo "</div>";
?>
<?php $this->end(); ?>