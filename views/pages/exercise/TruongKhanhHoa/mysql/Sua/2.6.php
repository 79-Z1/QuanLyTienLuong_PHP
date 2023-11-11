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
    $sql = 'select * from sua';
    $result = mysqli_query($conn, $sql);
    $ds_sua = [];
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $ds_sua[] = array(
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
                    <img src="../Hinh_sua/<?= $sua['Hinh'] ?>" alt="">
                </div>
            <?php endforeach; ?>
        </div>  
    </div>
</body>

</html>