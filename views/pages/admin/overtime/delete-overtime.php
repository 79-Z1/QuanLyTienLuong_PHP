<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$maTC = $_GET["maTC"];
$getTangCa = "select * from tang_ca where MaTC='$maTC'";
$resultTangCa = mysqli_query($conn, $getTangCa);
$row = mysqli_fetch_array($resultTangCa, MYSQLI_ASSOC);
$maNV = $row["MaNV"];
$ngayTC = $row["NgayTC"];
$loaiTC = $row["LoaiTC"];

if ($row['LoaiTC'] == 0) {
    $loaiTC = "Ngày thường";
} else if ($row['LoaiTC'] == 1) {
    $loaiTC = "Nghỉ hàng tuần";
} else $loaiTC = "Nghỉ lễ";
$err = array();


?>
<?php

if (isset($_POST['delete'])) {
    $sqldelete = "delete from tang_ca where MaTC = '$maTC'";
    $deleteResult = mysqli_query($conn, $sqldelete);
    if ($deleteResult) {
        echo "<script type='text/javascript'>
        $('#delete').prop('disabled','disabled');
        toastr.success('Xoá thành công');
        setTimeout(function() {
            window.location.href = '/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/admin?page=admin-overtime" . "';
        }, 1000);
        </script>";
    } else {
        echo "<script type='text/javascript'>toastr.error('Xóa không thành công'); toastr.options.timeOut = 3000;</script>";
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
                            <td><input class="form-control py-2" type="text" size="20" name="maTC" value="<?php echo $row["MaTC"]; ?>" disabled="disabled" /></td>
                            <td>Mã nhân viên</td>
                            <td><input class="form-control py-2" type="text" name="maNV" value="<?php echo $maNV; ?>" disabled="disabled" /></td>
                        </tr>
                        <tr class="tr">
                            <td>Ngày tăng ca </td>
                            <td><input class="form-control py-2" type="text" size="20" name="ngayTC" value="<?php echo $ngayTC; ?>" disabled="disabled" /></td>
                            <td>Loại tăng ca </td>
                            <td>
                                <input class="form-control py-2" type="text" size="20" name="loaiTC" value="<?php echo $loaiTC; ?>" disabled="disabled" />
                            </td>
                        </tr>
                        <tr>
                            <td id="no_color" align="center" colspan="4">
                                <button class="btn btn-outline-danger themnhanvien-btn mb-5 w-25" type="button" data-bs-toggle="modal" data-bs-target="#xacnhanxoa">Xoá</button>
                                <a class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" href="index.php?page=admin-overtime">Quay Lại</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Xác nhận xóa -->
<div class="modal fade" id="xacnhanxoa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xoá tăng ca <strong><?php echo $row["MaTC"]; ?></strong> không?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <form action="" method="post">
                    <input id="delete" class="btn btn-danger" type="submit" value="Xoá" name="delete" />
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->end(); ?>