<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$maTS = $_GET["maTS"];
$getThamSo = "select * from tham_so where MaTS='$maTS'";
$resultThamSo = mysqli_query($conn, $getThamSo);
$row = mysqli_fetch_array($resultThamSo, MYSQLI_ASSOC);
$tenTS = $row["TenTS"];
$DVT = $row["DVT"];
$giaTri = $row["GiaTri"];
$tinhTrang = $row["TinhTrang"];

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
    $sqldelete = "delete from tham_so where MaTS = '$maTS'";
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
                <h3 class="mb-0">THÊM THAM SỐ</h3>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr class="tr">
                            <td>Mã tham số</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maTS" value="<?php echo $row["MaTS"]; ?>" disabled/></td>
                            <td>Tên tham số</td>
                            <td><input class="form-control py-2" type="text" size="20" name="tenTS" value="<?php echo $row["TenTS"]; ?>" disabled/></td>
                        </tr>
                        <tr class="tr">
                            <td>Đơn vị tính </td>
                            <td>
                            <input class="form-control py-2" type="text" size="20" name="DVT" value="<?php echo $row["DVT"]; ?>" disabled/>
                            </td>
                            <td>Giá trị</td>
                            <td>
                                <input class="form-control py-2" type="text" size="20" name="giaTri" value="<?php echo $row["GiaTri"]; ?>" disabled/>
                            </td>
                        </tr>
                        <tr class="tr">
                            <td>Tình trạng</td>
                            <td>
                                <input class="form-control py-2" type="text" size="20" name="tinhTrang" value="<?php echo $row["TinhTrang"]; ?>" disabled/>
                            </td>
                        </tr>
                        <tr class="tr">
                            <td id="no_color" align="center" colspan="4">
                                <input type="submit" value="Xóa" name="delete" class="btn btn-outline-purple me-3 themnhanvien-btn mb-5 w-25" />
                                <a class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" href="index.php?page=admin-parameter">Quay Lại</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->end(); ?>