<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin khách hàng</title>
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

    if (isset($_POST['ten']))
        $ten = trim($_POST['ten']);
    else $ten = $rows['Ten_khach_hang'];

    if (isset($_POST['diachi']))
        $diaChi = trim($_POST['diachi']);
    else $diaChi = $rows['Dia_chi'];

    if (isset($_POST['sdt']))
        $sdt = trim($_POST['sdt']);
    else $sdt = $rows['Dien_thoai'];

    if (isset($_POST['email']))
        $email = trim($_POST['email']);
    else $email = $rows['Email'];


    if ($rows['Phai'] == 1) $gt = 'Nữ';
    else $gt = 'Nam';

    if (isset($_POST['xacnhan'])) {

        if ($sdt != "" && $ten != "" && $diaChi != "" && $email != ""){
            $sqlUpdate = "UPDATE `khach_hang` 
        SET `Ten_khach_hang`='$_POST[ten]',`Phai`='$_POST[radGT]',`Dia_chi`='$_POST[diachi]',`Dien_thoai`='$_POST[sdt]',`Email`='$_POST[email]'
        WHERE `Ma_khach_hang` = '$_GET[MaKH]'";
        mysqli_query($conn, $sqlUpdate);
        echo "<script type='text/javascript'>toastr.success('Chỉnh sửa thành công')</script>";
        }else{
            echo "<script type='text/javascript'>
                toastr.error('Vui lòng nhập đầy đủ thông tin');
            </script>";
        }
    }

    ?>
    <h1>Chỉnh sửa thông tin khách hàng</h1>
    <form action="" method="post">
        <table>
            <tr>
                <td>Mã khách hàng</td>
                <td><input type="text" value="<?= $rows['Ma_khach_hang'] ?>" disabled></td>
            </tr>
            <tr>
                <td>Tên khách hàng</td>
                <td><input type="text" value="<?= $ten ?>" name="ten"></td>
            </tr>
            <tr>
                <td>Phái</td>
                <td>
                    <input type="radio" name="radGT" value="0" <?php if (isset($_POST['radGT']) || $rows['Phai'] == 0) echo 'checked="checked"'; ?> checked />
                    Nam
                    <input type="radio" name="radGT" value="1" <?php if (isset($_POST['radGT']) || $rows['Phai'] == 1) echo 'checked="checked"'; ?> />
                    Nữ
                </td>
            </tr>
            <tr>
                <td>Địa chỉ</td>
                <td><input type="text" value="<?= $diaChi ?>" name="diachi"></td>
            </tr>
            <tr>
                <td>Số điện thoại</td>
                <td><input type="text" value="<?= $sdt ?>" name="sdt"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" value="<?= $email ?>" name="email"></td>
            </tr>
            <tr>
                <td><input class="btn btn-success" type="submit" name="xacnhan" value="Xác nhận"></td>
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