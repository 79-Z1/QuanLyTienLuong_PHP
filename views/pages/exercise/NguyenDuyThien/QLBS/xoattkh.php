<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xoá thông tin khách hàng</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>

<body>
    <?php
    require("connect.php");

    $sqlgetTT = "select * from khach_hang where Ma_khach_hang = '$_GET[MaKH]'";

    $resultgetTT = mysqli_query($conn, $sqlgetTT);

    $rows = mysqli_fetch_array($resultgetTT);

    $gt = '';

    $ten = $rows['Ten_khach_hang'];
    $diachi = $rows['Dia_chi'];
    $sdt = $rows['Dien_thoai'];
    $email = $rows['Email'];
    

    if ($rows['Phai'] == 1) $gt = 'Nữ';
    else $gt = 'Nam';

    if (isset($_POST['xoa'])) {
        $sqlDelete = "DELETE FROM `khach_hang`
        WHERE `Ma_khach_hang` = '$_GET[MaKH]'";
        mysqli_query($conn, $sqlDelete);
        echo "<script type='text/javascript'>toastr.success('Xoá thành công')</script>";
    }

    ?>
    <h1>Xoá thông tin khách hàng</h1>
    <form action="" method="post">
        <table>
            <tr>
                <td>Mã khách hàng</td>
                <td><input type="text" value="<?= $rows['Ma_khach_hang'] ?>" disabled></td>
            </tr>
            <tr>
                <td>Tên khách hàng</td>
                <td><input type="text" value="<?= $ten ?>" name="ten" disabled></td>
            </tr>
            <tr>
                <td>Phái</td>
                <td><input type="text" value="<?= $gt ?>" name="ten" disabled></td>
            </tr>
            <tr>
                <td>Địa chỉ</td>
                <td><input type="text" value="<?= $diachi ?>" name="diachi" disabled></td>
            </tr>
            <tr>
                <td>Số điện thoại</td>
                <td><input type="text" value="<?= $sdt ?>" name="sdt" disabled></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" value="<?= $email ?>" name="email" disabled></td>
            </tr>
            <tr>
                <td><input class="btn btn-danger" type="submit" name="xoa" value="Xoá"></td>
            </tr>
        </table>
    </form>
</body>
<a href="index.php?page=QLBSttkh" class="btn btn-primary">Trở về thông tin khách hàng</a>
<form action="" method="get">
<input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>
</html>
<?php $this->end(); ?>