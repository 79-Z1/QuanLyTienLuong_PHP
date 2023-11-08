<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$maPL = $_GET["maPL"];
$getPhieuLuong = "select * from phieu_luong where MaPhieuLuong='$maPL'";
$resultPhieuLuong = mysqli_query($conn, $getPhieuLuong);
$row = mysqli_fetch_array($resultPhieuLuong, MYSQLI_ASSOC);
$maNV = $row["MaNV"];
$thang = $row["Thang"];
$nam = $row["Nam"];
$soNgayCong = $row["SoNgayCong"];
$soNgayVang = $row["SoNgayVang"];
$luongTangCa = $row["LuongTangCa"];
$luongTamUng = $row["TienTamUng"];
$thue = $row["Thue"];
$truBaoHiem = $row["TruBaoHiem"];
$troCap = $row["TroCap"];
$thuong = $row["Thuong"];
$phat = $row["Phat"];
$tienLuongThang = $row["TienLuongThang"];
$tongThuNhap = $row["TongThuNhap"];
$thucLinh = $row["ThucLinh"];
$ghiChu = $row["GhiChu"];

$err = array();


?>
<?php
if (isset($_POST['delete'])) {
    $sqldelete = "delete from phieu_luong where MaPhieuLuong = '$maPL'";
    $deleteResult = mysqli_query($conn, $sqldelete);
    if ($deleteResult) {
        echo "<script type='text/javascript'>
        $('#delete').prop('disabled','disabled');
        toastr.success('Xoá thành công');
        setTimeout(function() {
            window.location.href = '/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/admin?page=admin-paycheck" . "';
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
                <h5 class="mb-0">XÓA PHIẾU LƯƠNG</h5>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr class="tr">
                            <td>Mã phiếu lương</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maPL" value="<?php echo $row['MaPhieuLuong']; ?>" disabled /></td>
                            <td>Mã nhân viên</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maPL" value="<?php echo $row['MaNV']; ?>" disabled /></td>
                            </td>
                        </tr>
                        <tr class="tr">
                            <td>Tháng</td>
                            <td><input class="form-control py-2" type="text" size="20" name="thang" value="<?php echo $thang; ?>" disabled/></td>
                            <td>Năm</td>
                            <td><input class="form-control py-2" type="text" name="nam" value="<?php echo $nam; ?>" disabled/></td>
                        </tr>
                        <tr class="tr">
                            <td>Số ngày công</td>
                            <td><input class="form-control py-2" type="text" size="20" name="soNgayCong" value="<?php echo $row['SoNgayCong']; ?> " disabled/></td>
                            <td>Số ngày vắng</td>
                            <td><input class="form-control py-2" type="text" name="soNgayVang" value="<?php echo $row['SoNgayVang']; ?> " disabled/></td>
                        </tr>
                        <tr class="tr">
                            <td>Lương tăng ca</td>
                            <td><input class="form-control py-2" type="text" size="20" name="luongTangCa" value="<?php echo $row['LuongTangCa']; ?> " disabled/></td>
                            <td>Lương tạm ứng</td>
                            <td><input class="form-control py-2" type="text" name="luongTamUng" value="<?php echo $row['TienTamUng']; ?> "disabled /></td>
                        </tr>
                        <tr class="tr">
                            <td>Thuế</td>
                            <td><input class="form-control py-2" type="text" size="20" name="thue" value="<?php echo $row['Thue']; ?> "disabled /></td>
                            <td>Trừ bảo hiểm</td>
                            <td><input class="form-control py-2" type="text" name="truBaoHiem" value="<?php echo $row['TruBaoHiem']; ?> " disabled/></td>
                        </tr>
                        <tr class="tr">
                            <td>Trợ cấp</td>
                            <td><input class="form-control py-2" type="text" size="20" name="troCap" value="<?php echo $row['TroCap']; ?> "disabled /></td>
                            <td>Thưởng</td>
                            <td><input class="form-control py-2" type="text" name="thuong" value="<?php echo $row['Thuong']; ?> "disabled /></td>
                        </tr>
                        <tr class="tr">
                            <td>Phạt</td>
                            <td><input class="form-control py-2" type="text" size="20" name="phat" value="<?php echo $row['Phat']; ?> " disabled/></td>
                            <td>Tiền lương tháng</td>
                            <td><input class="form-control py-2" type="text" name="tienLuongThang" value="<?php echo $row['TienLuongThang']; ?> " disabled/></td>
                        </tr>
                        <tr class="tr">
                            <td>Tổng thu nhập</td>
                            <td><input class="form-control py-2" type="text" size="20" name="tongThuNhap" value="<?php echo $row['TongThuNhap']; ?> " disabled/></td>
                            <td>Thực Lĩnh</td>
                            <td><input class="form-control py-2" type="text" name="thucLinh" value="<?php echo $row['ThucLinh']; ?> " disabled/></td>
                        </tr>
                        <tr class="tr">
                            <td>Ghi chú</td>
                            <td id="no_colo" r>
                                <div class="input-group input-group-lg">
                                    <textarea disabled class="form-control" name="ghiChu" rows="3" maxlength="300"> <?php echo $row['GhiChu']; ?></textarea>
                                </div>
                            </td>
                            <td align="center" id="no_color" colspan="2">
                            <button class="btn btn-outline-danger themnhanvien-btn mb-5 w-25" type="button" data-bs-toggle="modal" data-bs-target="#xacnhanxoa">Xoá</button>
                                <a class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" href="index.php?page=admin-paycheck">Quay Lại</a>
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
                <p>Bạn có chắc chắn muốn xoá phiếu lương <strong><?php echo $row["MaPhieuLuong"]; ?></strong> không?</p>
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