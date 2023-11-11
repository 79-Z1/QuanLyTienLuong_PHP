<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$conn = mysqli_connect('localhost', 'root', '', 'qlbansua')
    or die('Could not connect to MySQL: ' . mysqli_connect_error());

$maKH = $_GET["maKH"];
$getKH = "select Ma_khach_hang,Ten_khach_hang,Phai,Dia_chi,Dien_thoai,Email from khach_hang where Ma_khach_hang='$maKH'";
$resultKH = mysqli_query($conn, $getKH);
$row = mysqli_fetch_array($resultKH, MYSQLI_ASSOC);
$tenKH = $row["Ten_khach_hang"];
$phai = $row["Phai"];
$diaChi = $row["Dia_chi"];
$dienThoai = $row["Dien_thoai"];
$email = $row["Email"];

if (isset($_POST['delete'])) {
        $sqldelete = "delete from khach_hang where Ma_khach_hang = '$maKH'";
        $deleteResult = mysqli_query($conn, $sqldelete);
        echo "<script type='text/javascript'>
        $('#delete').prop('disabled','disabled');
        toastr.success('Xoá thành công');
        </script>";
}
?>


<div class="card-header">
    <h5 class="mb-0">SỬA THÔNG TIN KHÁCH HÀNG</h5>
</div>
<div class="table-responsive">
    <form align='center' action="" method="post" enctype="multipart/form-data">
        <table class="table table-hover table-nowrap">
            <tr class="tr">
                <td>Mã khách hàng</td>
                <td><input class="form-control py-2" type="text" size="20" name="maCV" value="<?php echo $row["Ma_khach_hang"]; ?> " disabled /></td>
                <td>Tên khách hàng</td>
                <td><input class="form-control py-2" type="text" name="tenKH" value="<?php echo $tenKH; ?>" disabled /></td>
            </tr>
            <tr class="tr">
                <td>Phái</td>
                <td><input class="form-control py-2" type="text" size="20" name="phai" value="<?php echo $phai; ?> " disabled /></td>
                <td>Địa chỉ</td>
                <td><input class="form-control py-2" type="text" name="diaChi" value="<?php echo $diaChi; ?>" disabled /></td>
            </tr>
            <tr class="tr">
                <td>Số điện thoại</td>
                <td><input class="form-control py-2" type="text" size="20" name="SDT" value="<?php echo $dienThoai; ?> " disabled/></td>
                <td>Email</td>
                <td><input class="form-control py-2" type="text" name="email" value="<?php echo $email; ?>" disabled /></td>
            </tr>
            <tr class="tr">
                <td id="no_color" colspan="8" align="center">
                    <input type="submit" value="Xóa" name="delete" class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" />
                    <a class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" href="index.php?page=LHT-CSDL_MySQL-Info-KhachHang"> Quay Lại</a>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php $this->end(); ?>