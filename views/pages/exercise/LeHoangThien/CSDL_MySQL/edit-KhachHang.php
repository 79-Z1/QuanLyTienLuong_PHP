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


if (isset($_POST["tenKH"])) {
    $tenKH = $_POST['tenKH'];
}
if (isset($_POST["phai"])) {
    $phai = $_POST['phai'];
}
if (isset($_POST["diaChi"])) {
    $diaChi = $_POST['diaChi'];
}
if (isset($_POST["dienThoai"])) {
    $dienThoai = $_POST['dienThoai'];
}
if (isset($_POST["email"])) {
    $email = $_POST['email'];
}

if (isset($_POST['edit'])) {
    $err = array();
    
    if (empty($tenKH)) {
        $err[] = "Vui lòng nhập tên khách hàng";
    }
    if (empty($phai)) {
        $err[] = "Vui lòng nhập giới tính";
    } 
    if (empty($diaChi)) {
        $err[] = "Vui lòng nhập nhập địa chỉ";
    }
    if (empty($dienThoai) ) {
        $err[] = "Vui lòng nhập điện thoại";
    } 
    if (empty($email) ) {
        $err[] = "Vui lòng nhập email";
    } 

    if (empty($err)) {
        $sqlupdate = " UPDATE `khach_hang` SET `Ma_khach_hang`='$maKH',`Ten_khach_hang`='$tenKH',`Phai`='$phai',`Dia_chi`='$diaChi',`Dien_thoai`='$dienThoai',`Email`='$email' WHERE Ma_khach_hang='$maKH'";
        $resultupdate = mysqli_query($conn, $sqlupdate);
        echo "<script type='text/javascript'>toastr.success('Sửa thành công'); toastr.options.timeOut = 3000;</script>";
    } else {
        foreach ($err as $error) {
            echo "<script type='text/javascript'>toastr.error(' $error'); toastr.options.timeOut = 3000;</script>";
        }
    }
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
                            <td><input class="form-control py-2" type="text" size="20" name="maCV"
                                    value="<?php echo $row["Ma_khach_hang"]; ?> " disabled /></td>
                            <td>Tên khách hàng</td>
                            <td><input class="form-control py-2" type="text" name="tenKH"
                                    value="<?php echo $tenKH; ?>" /></td>
                        </tr>
                        <tr class="tr">
                            <td>Phái</td>
                            <td><input class="form-control py-2" type="text" size="20" name="phai"
                                    value="<?php echo $phai; ?> " /></td>
                            <td>Địa chỉ</td>
                            <td><input class="form-control py-2" type="text" name="diaChi"
                                    value="<?php echo $diaChi; ?>" /></td>
                        </tr>
                        <tr class="tr">
                            <td>Số điện thoại</td>
                            <td><input class="form-control py-2" type="text" size="20" name="SDT"
                                    value="<?php echo $dienThoai; ?> " /></td>
                            <td>Email</td>
                            <td><input class="form-control py-2" type="text" name="email"
                                    value="<?php echo $email; ?>" /></td>
                        </tr>
                        <tr class="tr">
                            <td id="no_color" colspan="8" align="center">
                                <input type="submit" value="Lưu" name="edit"
                                    class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" />
                                <a class="btn btn-outline-purple themnhanvien-btn mb-5 w-25"
                                    href="index.php?page=LHT-CSDL_MySQL-Info-KhachHang"> Quay Lại</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
<?php $this->end(); ?>