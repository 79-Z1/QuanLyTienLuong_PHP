<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$sqlNhanVien = 'select * from nhan_vien ';
$resultNhanVien = mysqli_query($conn, $sqlNhanVien);

$maTC = $_GET["maTC"];
$getTangCa = "select * from tang_ca where MaTC='$maTC'";
$resultTangCa = mysqli_query($conn, $getTangCa);
$row = mysqli_fetch_array($resultTangCa, MYSQLI_ASSOC);
$maNV = $row["MaNV"];
$ngayTC = $row["NgayTC"];
$loaiTC = $row["LoaiTC"];

$err = array();


?>
<style>
    .form-control.form-select {
        padding-top: 0.3rem !important;
        padding-bottom: 0.3rem !important;

    }

    .form-select {
        width: 100%;
        padding-left: 20px;
    }
</style>
<?php

if (isset($_POST['delete'])) {
    $sqldelete = "delete from tang_ca where MaTC = '$maTC'";
    $deleteResult = mysqli_query($conn, $sqldelete);
    if ($deleteResult) {
        echo '<div class="alert alert-success">Xóa thành công!</div>';
    } else {
        echo '<div class="alert alert-danger">Xóa thất bại!</div>';
    }
}

?>
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">XÓA TĂNG CA</h5>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr class="tr">
                            <td>Mã tăng ca</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maTC" value="<?php echo $row["MaTC"]; ?> " disabled="disabled" /></td>
                            <td>Mã nhân viên</td>
                            <td><input class="form-control py-2" type="text" name="maNV" value="<?php echo $maNV; ?>" disabled="disabled" /></td>
                        </tr>
                        <tr class="tr">
                            <td>Ngày tăng ca </td>
                            <td><input class="form-control py-2" type="text" size="20" name="ngayTC" value="<?php echo $ngayTC; ?>" disabled="disabled" /></td>
                            <td>Loại tăng ca </td>
                            <td><input class="form-control py-2" type="text" size="20" name="loaiTC" value="<?php echo $loaiTC; ?>" disabled="disabled" /></td>
                        </tr>
                        <tr>
                            <td id="no_color" align="center" colspan="4">
                                <input type="submit" value="Xóa" name="delete" class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" />
                                <a class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" href="index.php?page=admin-overtime"> Quay Lại</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->end(); ?>