<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Thông tin sữa</title>
</head>

<style>
    .pagination-link {
        display: inline-block;
        padding: 3px 5px;
        margin: 1PX;
        border: 1px solid #ccc;
        text-decoration: none;
        color: #333;
        font-size: 12px;
        border-radius: 15px;
    }

    .pagination-link.active {
        background-color: #333;
        color: #fff;

    }

    .pagination-link:not(.active) {
        font-weight: 400;
        font-size: 12px;
        color: #666;
    }
</style>

<body>
    <?php

    $conn = mysqli_connect('localhost', 'root', '', 'qlbansua')
        or die('Could not connect to MySQL: ' . mysqli_connect_error());
    $sql = 'select Ma_sua,ten_sua,Trong_luong,Don_gia from sua';

    $result = mysqli_query($conn, $sql);
    $rowsPerPage = 10; //số mẩu tin trên mỗi trang, giả sử là 10
    if (!isset($_GET['p'])) {
        $_GET['p'] = 1;
    }
    //vị trí của mẩu tin đầu tiên trên mỗi trang
    $offset = ($_GET['p'] - 1) * $rowsPerPage;

    //lấy $rowsPerPage mẩu tin, bắt đầu từ vị trí $offset
    $sql .= " LIMIT $offset,$rowsPerPage";
    $result = mysqli_query($conn, $sql);

    echo "<p align='center'><font size='5' color='blue'> THÔNG TIN SỮA </font></P>";

    echo "<table align='center' width='700' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>";

    echo '<tr>

    <th width="50">STT</th>

     <th width="50">Mã sữa</th>

    <th width="150">Tên sữa</th>

    <th width="200">Trọng lượng</th>

</tr>';



    if (mysqli_num_rows($result) <> 0) {
        $stt = 1;

        while ($rows = mysqli_fetch_row($result)) {
            echo "<tr>";

            echo "<td>$stt</td>";

            echo "<td>$rows[0]</td>";

            echo "<td>$rows[1]</td>";

            echo "<td>$rows[2]</td>";

            echo "</tr>";

            $stt += 1;
        }
    }

    echo "</table>";
    $re = mysqli_query($conn, 'select * from sua');
    //tổng số mẩu tin cần hiển thị
    $numRows = mysqli_num_rows($re);
    //tổng số trang
    $maxPage = floor($numRows / $rowsPerPage) + 1;
    //gắn thêm nút Back
    echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=LHT-CSDL_MySQL-PhanTrang&p=1 >Về đầu</a> ";
    echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=LHT-CSDL_MySQL-PhanTrang&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "><</a> ";
    for ($i = 1; $i <= $maxPage; $i++) {
        if ($i == $_GET['page']) {
            echo '<b>' . $i . '</b> '; //trang hiện tại sẽ được bôi đậm
        } else
            echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=LHT-CSDL_MySQL-PhanTrang&p=" . $i . ">" . $i . "</a> ";
    }
    //gắn thêm nút Next
    echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=LHT-CSDL_MySQL-PhanTrang&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">></a>";
    echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=LHT-CSDL_MySQL-PhanTrang&p=" . $maxPage . ">Về cuối</a> ";
    ?>
</body>

</html>
<?php $this->end(); ?>