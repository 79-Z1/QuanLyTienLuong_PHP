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
<?php

if (isset($_POST['delete'])) {
    $sqldelete = "delete from tham_so where MaTS = '$maTS'";
    $deleteResult = mysqli_query($conn, $sqldelete);
    if ($deleteResult) {
        echo "<script type='text/javascript'>
        $('#delete').prop('disabled','disabled');
        toastr.success('Xoá thành công');
        setTimeout(function() {
            window.location.href = '/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/admin?page=admin-parameter" . "';
        }, 1500);
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
                <h3 class="mb-0">XÓA THAM SỐ</h3>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr class="tr">
                            <td>Mã tham số</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maTS" value="<?php echo $row["MaTS"]; ?>" disabled /></td>
                            <td>Tên tham số</td>
                            <td><input class="form-control py-2" type="text" size="20" name="tenTS" value="<?php echo $row["TenTS"]; ?>" disabled /></td>
                        </tr>
                        <tr class="tr">
                            <td>Đơn vị tính </td>
                            <td>
                                <input class="form-control py-2" type="text" size="20" name="DVT" value="<?php echo $row["DVT"]; ?>" disabled />
                            </td>
                            <td>Giá trị</td>
                            <td>
                                <input class="form-control py-2" type="text" size="20" name="giaTri" value="<?php echo $row["GiaTri"]; ?>" disabled />
                            </td>
                        </tr>
                        <tr class="tr">
                            <td>Tình trạng</td>
                            <td>
                                <input class="form-control py-2" type="text" size="20" name="tinhTrang" value="<?php echo $row["TinhTrang"]; ?>" disabled />
                            </td>
                        </tr>
                        <tr class="tr">
                            <td id="no_color" align="center" colspan="4">
                                <button class="btn btn-outline-danger themnhanvien-btn mb-5 w-25" type="button" data-bs-toggle="modal" data-bs-target="#xacnhanxoa">Xoá</button>
                                <a class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" href="index.php?page=admin-parameter">Quay Lại</a>
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
                <p>Bạn có chắc chắn muốn xoá tham số <strong><?php echo $row["MaTS"]; ?></strong> không?</p>
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