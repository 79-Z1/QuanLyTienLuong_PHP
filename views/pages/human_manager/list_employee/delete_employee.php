<?php $this->layout('layout_manager') ?>
<?php $this->section('content'); ?>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
$maNV = $_GET['MaNV'];
$sqlNhanVien = "select * from nhan_vien, phong_ban,chuc_vu
	where nhan_vien.MaChucVu = chuc_vu.MaChucVu and nhan_vien.MaPhong= phong_ban.MaPhong AND nhan_vien.MaNV='$maNV'	 ";
$resultNhanVien = mysqli_query($conn, $sqlNhanVien);
$ttNV = mysqli_fetch_array($resultNhanVien);

if ($ttNV['GioiTinh'] == 0) $gt = "Nữ";
else $gt = "Nam";


if (isset($_POST['xoa'])) {

    $sqldeleteTK = "DELETE FROM `tai_khoan` WHERE MaNV = '$maNV'";
    mysqli_query($conn,$sqldeleteTK);

    $sqlSelectCC = "SELECT * FROM `cham_cong` WHERE MaNV = '$maNV'";
    //nếu tồn tại $maNV ở bảng chấm công thì sẽ xoá tất cả bản ghi có $maNV
    if(mysqli_num_rows(mysqli_query($conn,$sqlSelectCC)) > 0){
        $sqldeleteCC = "DELETE FROM `cham_cong` WHERE MaNV = '$maNV'";
        mysqli_query($conn,$sqldeleteCC);
    }

    $sqlSelectPL = "SELECT * FROM `phieu_luong` WHERE MaNV = '$maNV'";
    //nếu tồn tại $maNV ở bảng phiếu lương thì sẽ xoá tất cả bản ghi có $maNV
    if(mysqli_num_rows(mysqli_query($conn,$sqlSelectPL)) > 0){
        $sqldeletePL = "DELETE FROM `phieu_luong` WHERE MaNV = '$maNV'";
        mysqli_query($conn,$sqldeletePL);
    }
    
    $sqlSelectPUL = "SELECT * FROM `phieu_ung_luong` WHERE MaNV = '$maNV'";
    //nếu tồn tại $maNV ở bảng phiếu ứng lương thì sẽ xoá tất cả bản ghi có $maNV
    if(mysqli_num_rows(mysqli_query($conn,$sqlSelectPUL)) > 0){
        $sqldeletePUL = "DELETE FROM `phieu_ung_luong` WHERE MaNV = '$maNV'";
        mysqli_query($conn,$sqldeletePUL);
    }

    $sqlSelectTC = "SELECT * FROM `tang_ca` WHERE MaNV = '$maNV'";
    //nếu tồn tại $maNV ở bảng tăng ca thì sẽ xoá tất cả bản ghi có $maNV
    if(mysqli_num_rows(mysqli_query($conn,$sqlSelectTC)) > 0){
        $sqldeleteTC = "DELETE FROM `tang_ca` WHERE MaNV = '$maNV'";
        mysqli_query($conn,$sqldeleteTC);
    }
    
    $sqlSelectTB = "SELECT * FROM `thong_bao` WHERE NguoiGui = '$maNV'";
    //nếu tồn tại $maNV ở bảng thông báo thì sẽ xoá tất cả bản ghi có $maNV
    if(mysqli_num_rows(mysqli_query($conn,$sqlSelectTB)) > 0){
        $sqldeleteTB = "DELETE FROM `thong_bao` WHERE NguoiGui = '$maNV'";
        mysqli_query($conn,$sqldeleteTB);
    }

    $sqlNV = "DELETE FROM `nhan_vien` WHERE MaNV = '$maNV'";
    mysqli_query($conn,$sqlNV);

    echo "<script type='text/javascript'>
    $('#xoa').prop('disabled','disabled');
    toastr.success('Xoá thành công');
    setTimeout(function() {
        window.location.href = '/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/admin?page=admin-staff" . "';
    }, 1500);
    </script>";
}
?>
<body>
    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center ">
                                <img <?php echo "src='" .  '/' . explode('/', $_SERVER["PHP_SELF"])[1] . "/assets/images/imgnv/$ttNV[Hinh]" . "' alt='Avatar' " ?> class="rounded-circle" width="150">
                                <div class="mt-3 p-2">
                                    <h1><?php echo "$ttNV[HoNV]     $ttNV[TenNV]"  ?></h1>
                                    <h3 class=" mb-1"><?php echo "$ttNV[TenChucVu]" ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mã nhân viên</h6>
                                </div>
                                <div class="col-sm-9  " style="font-size: 18px;">
                                    <?php echo "$ttNV[MaNV]" ?>
                                </div>
                            </div>
                            <div class="hr"> </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phòng</h6>
                                </div>
                                <div class="col-sm-9  " style="font-size: 18px;">
                                    <?php echo "$ttNV[TenPhong]" ?>
                                </div>
                            </div>
                            <div class="hr"> </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Giới Tính</h6>
                                </div>
                                <div class="col-sm-9 " style="font-size: 18px;">

                                    <?php echo "$gt " ?>
                                </div>
                            </div>
                            <div class="hr"> </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Ngày Sinh</h6>
                                </div>
                                <div class="col-sm-9 " style="font-size: 18px;">
                                    <?php echo "$ttNV[NgaySinh]" ?>
                                </div>
                            </div>
                            <div class="hr"> </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Địa Chỉ</h6>
                                </div>
                                <div class="col-sm-9 " style="font-size: 18px;">
                                    <?php echo "$ttNV[DiaChi]" ?>
                                </div>
                            </div>
                            <div class="hr"> </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Số Tài Khoản</h6>
                                </div>
                                <div class="col-sm-9 " style="font-size: 18px;">
                                    <?php echo "$ttNV[STK]" ?>
                                </div>
                            </div>
                            <div class="hr"> </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">CMND</h6>
                                </div>
                                <div class="col-sm-9 " style="font-size: 18px;">
                                    <?php echo "$ttNV[CCCD]" ?>
                                </div>
                            </div>
                            <div class="hr"> </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Số điện thoại</h6>
                                </div>
                                <div class="col-sm-9 " style="font-size: 18px;">
                                    <?php echo "$ttNV[SDT]" ?>
                                </div>
                            </div>
                            <div class="hr"> </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Số con</h6>
                                </div>
                                <div class="col-sm-9 " style="font-size: 18px;">
                                    <?php echo "$ttNV[SoCon]" ?>
                                </div>
                            </div>
                            <div class="hr"> </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Hệ số lương</h6>
                                </div>
                                <div class="col-sm-9 " style="font-size: 18px;">
                                    <?php echo "$ttNV[HeSoLuong]" ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='option-buttons d-flex justify-content-between'>
                <a href="index.php"><input class="btn btn-outline-purple" type="submit" value="Quay lại" /></a>
                <input class="btn btn-outline-danger" type="submit" value="Xoá" data-bs-toggle="modal" data-bs-target="#xacnhanxoa" />
            </div>
        </div>
    </div>
    <form action="" method="post">
        <div class="modal fade" id="xacnhanxoa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Bạn có chắc chắn muốn xoá nhân viên <?php echo "$ttNV[MaNV]" ?> không?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <input id="xoa" class="btn btn-danger" type="submit" value="Xoá" name="xoa" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
<?php $this->end(); ?>