<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

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
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Thong Tin sua</title>
    <style>
        body {
            margin: 0 auto;

        }

        .wrapper {
            display: block;
            width: 1200px;
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
            border: 1px solid #000;
        }

        img {
            width: 100px;
            padding: 10px;
        }
        .pagination-link {
            display: inline-block;
            padding: 5px 10px;
            margin: 0 5px;
            border: 1px solid #ccc;
            text-decoration: none;
            color: #333;
        }

        .pagination-link.active {
            background-color: #333;
            color: #fff;
        }
    </style>

</head>

<body>
    <?php
     $conn = mysqli_connect('localhost', 'root', '', 'qlbansua')
     or die('Could not connect to MySQL: ' . mysqli_connect_error());
     $sql = 'select * from sua ';
     $result = mysqli_query($conn, $sql);

    $rowsPerPage = 10; //số mẩu tin trên mỗi trang, giả sử là 10
    if (!isset($_GET['p'])) {
        $_GET['p'] = 1;
    }
    $offset = ($_GET['p'] - 1) * $rowsPerPage;

    $sql .= " LIMIT $offset,$rowsPerPage";
    $result = mysqli_query($conn, $sql);
    $dsSua = [];
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $dsSua[] = array(
            'Ma_sua' => $row['Ma_sua'],
            'Ma_hang_sua' => $row['Ma_hang_sua'],
            'Ten_sua' => $row['Ten_sua'],
            'Trong_luong' => $row['Trong_luong'],
            'Don_gia' => $row['Don_gia'],
            'Loi_ich' => $row['Loi_ich'],
            'Hinh' => $row['Hinh'],
        );
    }




    //lấy $rowsPerPage mẩu tin, bắt đầu từ vị trí $offset
    ?>
    <h1 align="center" style="background-color: blueviolet;">THÔNG TIN CÁC SẢN PHẨM</h1>
    <div class="wrapper">
        <div class="container">
            <?php foreach ($dsSua as $sua) : ?>
                <div class="item" align="center">
                    <a href="./chitietsua.php?masua=<?= $sua['Ma_sua'] ?>"><?= $sua['Ten_sua'] ?></a>
                    <p><?= $sua['Trong_luong'] . " - " . $sua['Don_gia'] ?></p>
                    <img src="Hinh_sua/<?= $sua['Hinh'] ?>" alt="">
                </div>
            <?php endforeach; ?>
        </div>
        

    </div>
    <br>
    <div align="center" >
            <?php
            $re = mysqli_query($conn, 'select * from sua');
            //tổng số mẩu tin cần hiển thị
            $numRows = mysqli_num_rows($re);
            //tổng số trang
            $maxPage = floor($numRows / $rowsPerPage) + 1;
            //gắn thêm nút Back
            echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=LHT-CSDL_MySQL-BT2_7&p=1 >Về đầu</a> ";
            echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=LHT-CSDL_MySQL-BT2_7&p=" . ($_GET['p'] > 1 ? $_GET['p'] - 1 : 1) . "><</a> ";
            for ($i = 1; $i <= $maxPage; $i++) {
                if ($i == $_GET['page']) {
                    echo '<b>' . $i . '</b> '; //trang hiện tại sẽ được bôi đậm
                } else
                    echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=LHT-CSDL_MySQL-BT2_7&p=" . $i . ">" . $i . "</a> ";
            }
            //gắn thêm nút Next
            echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=LHT-CSDL_MySQL-BT2_7&p=" . ($_GET['p'] < $maxPage ? $_GET['p'] + 1 : $maxPage) . ">></a>";
            echo "<a class='pagination-link' href=" . $_SERVER['PHP_SELF'] . "?page=LHT-CSDL_MySQL-BT2_7&p=" . $maxPage . ">Về cuối</a> ";
            ?>
        </div>
</body>

</html>
<?php $this->end(); ?>