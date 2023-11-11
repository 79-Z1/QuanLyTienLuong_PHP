<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Xóa khách hàng</title>
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
    $sqlCheck = "select * from hoa_don where Ma_khach_hang = '$_GET[maKH]'";
    $resultCheck = mysqli_query($conn, $sqlCheck);
    $check = mysqli_num_rows($resultCheck);

    $ttKH = mysqli_fetch_array($result);
    $tenKH = $ttKH['Ten_khach_hang'];

    $diaChi = $ttKH['Dia_chi'];

    $sdt = $ttKH['Dien_thoai'];

    $email = $ttKH['Email'];

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
                <td><input type="text" disabled  name="tenKH" value="<?php echo $tenKH; ?> " /></td>
            </tr>
            <tr>
                <td>Phái</td>
                <td>
                    <input type="radio" disabled name="radGT" value="0" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == '0' || $ttKH['Phai'] == '0') echo 'checked="checked"'; ?> checked />Nam
                    <input type="radio" disabled name="radGT" value="1" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == '1' || $ttKH['Phai'] == '1') echo 'checked="checked"'; ?> />Nữ

                </td>
            </tr>
            <tr>
                <td>Địa chỉ</td>
                <td><input type="text" disabled size="40" name="diaChi" value="<?php echo $diaChi; ?> " /></td>
            </tr>
            <tr>
                <td>Số điện thoại</td>
                <td><input type="text" disabled name="sdt" value="<?php echo $sdt; ?> " /></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" disabled size="30" name="email" value="<?php echo $email; ?> " /></td>
            </tr>
            <td colspan="2" align="center">
                <input id="delete" type="submit" value="Xóa" name="delete" />
            </td>
            </tr>
        </table>
        <p align="left"><a href="?page=TNT-QLBS-List-KH">Quay lại</a></p>
    </form>
    <?php 
        if (isset($_POST['delete'])) {
            if ($check <= 0) {
                $sqlDelete = "DELETE FROM `khach_hang` WHERE Ma_khach_hang = '$_GET[maKH]'";
                $resultDelete = mysqli_query($conn, $sqlDelete);
                echo "<script type='text/javascript'>
                    $('#delete').prop('disabled','disabled');
                    toastr.success('Xóa khách hàng thành công!');
                </script>";
            }
            else {echo "<script type='text/javascript'>
                toastr.error('Khách hàng này đã mua hàng! Không thể xóa khách hàng này');
            </script>";}
        }
    ?>
</body>
</html>
<?php $this->end(); ?>