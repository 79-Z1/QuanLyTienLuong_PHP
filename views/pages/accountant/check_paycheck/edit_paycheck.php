<?php $this->layout('layout_accountant') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$err = array();

$maPL = $_GET['MaPL'];

$sql = "select phieu_luong.*, nhan_vien.MaNV, HoNV, TenNV, TenPhong, TenChucVu, HeSoLuong from nhan_vien, phong_ban, chuc_vu, phieu_luong
          where nhan_vien.MaNV = '$_GET[MaNV]'
          and nhan_vien.MaPhong = phong_ban.MaPhong
          and nhan_vien.MaChucVu = chuc_vu.MaChucVu
          ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $ttNV = mysqli_fetch_array($result);
}

$sqlgetTTPL = "select * from phieu_luong where MaPhieuLuong = '$_GET[MaPL]'";

$resultgetTTPL = mysqli_query($conn,$sqlgetTTPL);

$TTPL = mysqli_fetch_array($resultgetTTPL);

$thang = $TTPL['Thang'];
$nam = $TTPL['Nam'];

$soNgayCong = $TTPL['SoNgayCong'];
$soNgayVang = $TTPL['SoNgayVang'];
$luongTC = $TTPL['LuongTangCa'];
$tienTamUng = $TTPL['TienTamUng'];
$thue = $TTPL['Thue'];
$troCap = $TTPL['TroCap'];
$truBH = $TTPL['TruBaoHiem'];
$tienThuong = $TTPL['Thuong'];
$tienPhat = $TTPL['Phat'];
$tienLuong = $TTPL['TienLuongThang'];
$tongThuNhap = $TTPL['TongThuNhap'];
$thucLinh = $TTPL['ThucLinh'];
$ghiChu = $TTPL['GhiChu'];

function Thue($thuNhap, $conn)
{
    $mucThueBac1 = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS008'"))['GiaTri'];
    $mucThueBac2 = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS009'"))['GiaTri'];
    $mucThueBac3 = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS010'"))['GiaTri'];
    $mucThueBac4 = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS011'"))['GiaTri'];
    $mucThueBac5 = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS012'"))['GiaTri'];
    $mucThueBac6 = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS013'"))['GiaTri'];
    $soThueBac1 = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS014'"))['GiaTri'] / 100;
    $soThueBac2 = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS015'"))['GiaTri'] / 100;
    $soThueBac3 = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS016'"))['GiaTri'] / 100;
    $soThueBac4 = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS017'"))['GiaTri'] / 100;
    $soThueBac5 = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS018'"))['GiaTri'] / 100;
    $soThueBac6 = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS019'"))['GiaTri'] / 100;
    $soThueBac7 = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS020'"))['GiaTri'] / 100;
    $giamTruBac2 = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS021'"))['GiaTri'];
    $giamTruBac3 = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS022'"))['GiaTri'];
    $giamTruBac4 = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS023'"))['GiaTri'];
    $giamTruBac5 = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS024'"))['GiaTri'];
    $giamTruBac6 = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS025'"))['GiaTri'];
    $giamTruBac7 = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS026'"))['GiaTri'];

    if ($thuNhap <= $mucThueBac1) {
        return $thuNhap * $soThueBac1;
    } elseif ($thuNhap > $mucThueBac1 && $thuNhap <= $mucThueBac2) {
        return $thuNhap * $soThueBac2 - $giamTruBac2;
    } elseif ($thuNhap > $mucThueBac2 && $thuNhap <= $mucThueBac3) {
        return $thuNhap * $soThueBac3 - $giamTruBac3;
    } elseif ($thuNhap > $mucThueBac3 && $thuNhap <= $mucThueBac4) {
        return $thuNhap * $soThueBac4 - $giamTruBac4;
    } elseif ($thuNhap > $mucThueBac4 && $thuNhap <= $mucThueBac5) {
        return $thuNhap * $soThueBac5 - $giamTruBac5;
    } elseif ($thuNhap > $mucThueBac5 && $thuNhap <= $mucThueBac6) {
        return $thuNhap * $soThueBac6 - $giamTruBac6;
    } elseif ($thuNhap > $mucThueBac6) {
        return $thuNhap * $soThueBac7 - $giamTruBac7;
    }
    return 0;
}

$mucLuongThue = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS007'"))['GiaTri'];

function MoneyFormat($tien)
{
    return number_format($tien, 0, ',', '.');
}


if (isset($_POST['tienPhat'])) {
    $tienPhat = str_replace(".", "", $_POST['tienPhat']);
}
if (isset($_POST['tienThuong'])) {
    $tienThuong = str_replace(".", "", $_POST['tienThuong']);
}


if (isset($_POST['tinh'])) {
    if($tienPhat < 0 ){
        $err[] = "Vui lòng nhập tiền phạt lớn hơn 0";
    }else if($tienPhat > 5000000 ){
        $err[] = "Vui lòng nhập tiền phạt nhỏ hơn 5000000";
    }
    if($tienThuong < 0 ){
        $err[] = "Vui lòng nhập tiền thưởng lớn hơn 0";
    }else if($tienThuong > 5000000 ){
        $err[] = "Vui lòng nhập tiền thưởng nhỏ hơn 5000000";
    }
    if(empty($err)){
        $tongThuNhap = $tienLuong + $troCap + $tienThuong + $luongTC - $tienPhat - $truBH;
        if ($tongThuNhap > $mucLuongThue) {
            $thue = Thue($tongThuNhap - $mucLuongThue, $conn);
        } else $thue = 0;
        $thucLinh = $tongThuNhap - $thue - $tienTamUng;
    }else {
        foreach($err as $lois){
            echo "<script type='text/javascript'>toastr.error('$lois');</script>";
        }
        
    }
}
if (isset($_POST['luu'])) {
    $ghiChu = trim($_POST['ghiChu']);
    
    $tongThuNhap = $tienLuong + $troCap + $tienThuong + $luongTC - $tienPhat - $truBH;
    if ($tongThuNhap > $mucLuongThue) {
        $thue = Thue($tongThuNhap - $mucLuongThue, $conn);
    } else $thue = 0;
    $thucLinh = $tongThuNhap - $thue - $tienTamUng;

    if ($ghiChu != "") {
        $sqlUpdatePL = "UPDATE `phieu_luong` 
        SET `Thue`='$thue', `Thuong`='$tienThuong', `Phat`='$tienPhat', `TongThuNhap`='$tongThuNhap',
        `ThucLinh`='$thucLinh',`GhiChu`='$ghiChu' 
        WHERE `MaPhieuLuong` = '$maPL'";
    } else {
        $sqlUpdatePL = "UPDATE `phieu_luong` 
        SET `Thue`='$thue', `Thuong`='$tienThuong', `Phat`='$tienPhat', `TongThuNhap`='$tongThuNhap',
        `ThucLinh`='$thucLinh',`GhiChu`= null 
        WHERE `MaPhieuLuong` = '$maPL'";
    }

    echo $sqlUpdatePL;
    mysqli_query($conn,$sqlUpdatePL);
    echo "<script type='text/javascript'>
                toastr.success('Phiếu lương tháng $thang năm $nam <br> Nhân viên $ttNV[HoNV] $ttNV[TenNV] <br> Đã được chỉnh sửa thành công!');
                setTimeout(function() {
                    window.location.href = '/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/accountant?page=accountant-check-paycheck" . "';
                }, 3000);
            </script>";
}
?>
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header d-flex justify-content-between">
                <h3 class="mb-0">CHỈNH SỬA PHIẾU LƯƠNG NHÂN VIÊN</h3>
                <h3 class="mb-0"><?php echo "Tháng " . $thang . " năm " . $nam; ?></h3>
            </div>
            <div class="table-responsive">
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr>
                            <td>Mã phiếu lương</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maPL" value="<?php echo $maPL; ?>" readonly /></td>
                            <td>Mã nhân viên</td>
                            <td><input class="form-control-left p-2" type="text" name="soCon" value="<?php echo $ttNV['MaNV']; ?> " readonly /></td>
                        </tr>
                        <tr>
                            <td>Họ và tên</td>
                            <td><input class="form-control-name py-2" type="text" size="20" name="hoTen" value="<?php echo $ttNV["HoNV"] . " " . $ttNV["TenNV"]; ?>" readonly /></td>
                            <td>Hệ số lương</td>
                            <td><input class="form-control-salary p-2" type="text" readonly size="20" name="HeSoLuong" value="<?php echo $ttNV["HeSoLuong"]; ?>" /></td>
                        </tr>
                        <tr>
                            <td>Phòng</td>
                            <td><input class="form-control-room py-2" type="text" name="Phong" value="<?php echo $ttNV["TenPhong"]; ?> " readonly /></td>
                            <td>Chức vụ</td>
                            <td><input class="form-control py-2" type="text" size="20" name="ChucVu" value="<?php echo $ttNV["TenChucVu"]; ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>Số ngày công</td>
                            <td><input class="form-control-date py-2" type="text" readonly size="5" name="SoNgayCong" value="<?php echo $soNgayCong; ?>" /></td>
                            <td>Số ngày vắng</td>
                            <td><input class="form-control-date py-2" type="text" readonly size="5" name="SoNgayVang" value="<?php echo $soNgayVang; ?>" /></td>
                        </tr>
                        <tr>
                            <td>Lương tăng ca</td>
                            <td><input class="td-control p-2" type="text" size="20" readonly name="luongTC" value="<?php echo MoneyFormat($luongTC); ?>" />VNĐ</td>
                            <td>Tiền tạm ứng</td>
                            <td><input class="td-control p-2" type="text" size="20" readonly name="tienTamUng" value="<?php echo MoneyFormat($tienTamUng); ?>" />VNĐ</td>
                        </tr>
                        <tr>
                            <td>Trợ cấp</td>
                            <td><input class="td-control p-2" type="text" size="20" name="troCap" value="<?php echo MoneyFormat($troCap); ?>" readonly />VNĐ</td>
                            <td>Trừ bảo hiểm</td>
                            <td><input class="td-control p-2" type="text" size="20" readonly name="truBh" value="<?php echo MoneyFormat($truBH); ?>" />VNĐ</td>
                        </tr>
                        <tr>
                            <td>Phạt</td>
                            <td><input class="td-control p-2" onchange="handleChange(this);" style="background-color: #FFF;" type="text" size="20" name="tienPhat" value="<?php echo  MoneyFormat($tienPhat); ?>" />VNĐ</td>
                            <td>Thưởng</td>
                            <td><input class="td-control p-2" onchange="handleChange(this);" style="background-color: #FFF;" type="text" size="20" name="tienThuong" value="<?php echo MoneyFormat($tienThuong); ?>">VNĐ</td>
                        </tr>
                        <tr>
                            <td>Tiền lương tháng</td>
                            <td><input class="td-control p-2" type="text" size="20" name="tienLuong" value="<?php echo MoneyFormat($tienLuong); ?>" readonly />VNĐ</td>
                            <td>Tổng thu nhập</td>
                            <td><input class="td-control p-2" type="text" size="20" name="tongThuNhap" value="<?php echo MoneyFormat($tongThuNhap); ?>" readonly />VNĐ</td>
                        </tr>
                        <tr>
                            <td>Thuế</td>
                            <td><input class="td-control p-2" type="text" size="20" readonly name="thue" value="<?php echo MoneyFormat($thue); ?>" />VNĐ</td>

                            <td>Thực lĩnh</td>
                            <td><input class="td-control p-2" type="text" size="20" name="thucLinh" value="<?php echo MoneyFormat($thucLinh); ?>" readonly />VNĐ</td>
                        </tr>
                        <tr>
                            <td>Ghi chú</td>
                            <td id="no_color">
                                <div class="input-group input-group-lg">
                                    <textarea class="form-control" name="ghiChu" rows="3" maxlength="300"> <?php if(isset($_POST['ghiChu']))echo htmlentities ($_POST['ghiChu']); else echo $ghiChu;?> </textarea>
                                </div>
                            </td>
                            <td id="no_color" align="center">
                                <input type="submit" value="Tính lương" id='tinh' name="tinh" class="btn btn-outline-purple themnhanvien-btn w-60" />
                            </td>
                            <td id="no_color" align="center">
                                <input type="submit" value="Chỉnh sửa phiếu lương" id='luu' name="luu" class="btn btn-outline-purple themnhanvien-btn w-30" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
?>
<?php $this->end(); ?>