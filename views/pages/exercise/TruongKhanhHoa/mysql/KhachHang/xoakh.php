<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<style type="text/css">
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
<?php
$conn = mysqli_connect('localhost', 'root', '', 'qlbansua')
    or die('Could not connect to MySQL: ' . mysqli_connect_error());
$sql = "select * from khach_hang where Ma_khach_hang = '$_GET[makh]'";
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

if (isset($_POST['delete'])) {
    if ($sdt != "" && $tenKH != "" && $diaChi != "" && $email != "") {
        $sqlDelete = "DELETE FROM `khach_hang` WHERE Ma_khach_hang = '$_GET[makh]'";
        $resultDelete = mysqli_query($conn, $sqlDelete);
        echo "<script type='text/javascript'>
                toastr.success('Xóa khách hàng thành công!');
                setTimeout(function() {
                    location.href='index.php'
                },2000)
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
                <h3>XÓA KHÁCH HÀNG</h3>
            </th>
        </thead>
        <tr>
            <td>Mã khách hàng</td>
            <td><input type="text" disabled name="maKH" value="<?php echo $_GET['makh']; ?> " /></td>
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
            <input type="submit" value="Xóa" name="delete" />
        </td>
        </tr>
        <tr>
            <td><a href="index.php">Quay lại</a></td>
        </tr>
    </table>
</form>
<?php $this->end(); ?>