<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Chỉnh sửa Thông Tin</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <style type="text/css">
        /*body {  
	            background-color: #d24dff;
	        }*/
        table {
            background: #ffd94d;
            border: 0 solid yellow;
        }

        thead {
            background: #fff14d;

        }

        td {
            color: black;

        }

        h3 {
            font-family: verdana;
            text-align: center;
            /* text-anchor: middle; */
            color: #ff8100;
            font-size: medium;
        }
    </style>
</head>

<body>
    <?php
    require("connect_qlbs.php");
    $sql = "select * from khach_hang where Ma_khach_hang = '$_GET[maKH]'";
    $result = mysqli_query($conn, $sql);
    $ttKH = mysqli_fetch_array($result);
    if (isset($_POST['tenKH']))
        $tenKH = trim($_POST['tenKH']);
    else $tenKH = $ttKH['Ten_khach_hang'];

    if (isset($_POST['diaChi']))
        $diaChi = trim($_POST['diaChi']);
    else $diaChi = $ttKH['Dia_chi'];

    if (isset($_POST['sdt']))
        $sdt = trim($_POST['sdt']);
    else $sdt = $ttKH['Dien_thoai'];

    if (isset($_POST['email']))
        $email = trim($_POST['email']);
    else $email = $ttKH['Email'];

    if (isset($_POST['update'])) {
        if ($sdt != "" && $tenKH != "" && $diaChi != "" && $email != "") {
            $sqlUpdate = "UPDATE `khach_hang` SET `Ten_khach_hang`='$tenKH',
                                `Phai`='$_POST[radGT]',`Dia_chi`='$diaChi',`Dien_thoai`='$sdt',`Email`='$email'
                                WHERE Ma_khach_hang = '$_GET[maKH]'";
            $resultUpdate = mysqli_query($conn, $sqlUpdate);
            echo "<script type='text/javascript'>
                toastr.success('Đã cập nhật thông tin khách hàng thành công!');
            </script>";
        }
        if ($sdt == "") {
            echo "<script type='text/javascript'>
                toastr.error('Số điện thoại không được để trống!');
            </script>";
        }
        if ($tenKH == "") {
            echo "<script type='text/javascript'>
                toastr.error('Tên khách hàng không được để trống!');
            </script>";
        }
        if ($diaChi == "") {
            echo "<script type='text/javascript'>
                toastr.error('Địa chỉ không được để trống!');
            </script>";
        }
        if ($email == "") {
            echo "<script type='text/javascript'>
                toastr.error('Email không được để trống!');
            </script>";
        }
    }

    ?>
    <form align='center' action="" method="post">

        <table>
            <thead>
                <th colspan="2" align="center">
                    <h3>THÔNG TIN KHÁCH HÀNG</h3>
                </th>
            </thead>
            <tr>
                <td>Mã khách hàng</td>
                <td><input type="text" disabled name="maKH" value="<?php echo $_GET['maKH']; ?> " /></td>
            </tr>
            <tr>
                <td>Tên khách hàng</td>
                <td><input type="text" name="tenKH" value="<?php echo $tenKH; ?> " /></td>
            </tr>
            <tr>
                <td>Phái</td>
                <td>
                    <input type="radio" name="radGT" value="0" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == '0' || $ttKH['Phai'] == '0') echo 'checked="checked"'; ?> checked />Nam
                    <input type="radio" name="radGT" value="1" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == '1' || $ttKH['Phai'] == '1') echo 'checked="checked"'; ?> />Nữ

                </td>
            </tr>
            <tr>
                <td>Địa chỉ</td>
                <td><input type="text" size="40" name="diaChi" value="<?php echo $diaChi; ?> " /></td>
            </tr>
            <tr>
                <td>Số điện thoại</td>
                <td><input type="text" name="sdt" value="<?php echo $sdt; ?> " /></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" size="30" name="email" value="<?php echo $email; ?> " /></td>
            </tr>
            <td colspan="2" align="center">
                <input type="submit" value="Cập nhật" name="update" />
            </td>
            </tr>
        </table>
        <p align="left"><a href="?page=TNT-QLBS-List-KH">Quay lại</a></p>
        
    </form>
</body>

</html>
<?php $this->end(); ?>