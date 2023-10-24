<?php $this->layout('layout_accountant') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/models/NhanVien.php");
// if (isset($_POST['SoNgayCong'])) {
//     $SoNgayCong = $_POST['SoNgayCong'];
// } else $SoNgayCong = 0;

// if (isset($_POST['HeSoLuong'])) {
//     $HeSoLuong = $_POST['HeSoLuong'];
// } else $HeSoLuong = 0;

// if (isset($_POST['LuongTC'])) {
//     $LuongTC = $_POST['LuongTC'];
// } else $LuongTC = 0;

// if (isset($_POST['TienTamUng'])) {
//     $TienTamUng = $_POST['TienTamUng'];
// } else $TienTamUng = 0;

// if (isset($_POST['Thue'])) {
//     $Thue = $_POST['Thue'];
// } else $Thue = 0;

// if (isset($_POST['TruBH'])) {
//     $TruBH = $_POST['TruBH'];
// } else $TruBH = 0;






$err = array();

$sql = "select MaNV, HoNV, TenNV, GioiTinh, SoCon, TenPhong, TenChucVu, HeSoLuong from nhan_vien, phong_ban, chuc_vu 
          where nhan_vien.MaNV = '$_GET[MaNV]'
          and nhan_vien.MaPhong = phong_ban.MaPhong
          and nhan_vien.MaChucVu = chuc_vu.MaChucVu
          ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $ttNV = mysqli_fetch_array($result);
}

$thang = $_GET['thang'];
$nam = $_GET['nam'];

if ($thang < 10) {
    $date = $nam . "0" . $thang;
} else $date = $nam . $thang;

function TaoMaPhieuLuong($maNV, $date)
{
    $ma = substr($maNV, 2, 3);
    return "PL" . $date . $ma;
}
function MoneyFormat($tien)
{
    return number_format($tien, 0, ',', '.');
}
function Thue($tienLuong)
{
    if ($tienLuong <= 5_000_000) {
        return $tienLuong * 0.05;
    } elseif ($tienLuong > 5_000_000 && $tienLuong <= 10_000_000) {
        return $tienLuong * 0.1 - 250_000;
    } elseif ($tienLuong > 10_000_000 && $tienLuong <= 18_000_000) {
        return $tienLuong * 0.15 - 750_000;
    } elseif ($tienLuong > 18_000_000 && $tienLuong <= 32_000_000) {
        return $tienLuong * 0.2 - 1_650_000;
    } elseif ($tienLuong > 32_000_000 && $tienLuong <= 52_000_000) {
        return $tienLuong * 0.25 - 3_250_000;
    } elseif ($tienLuong > 52_000_000 && $tienLuong <= 80_000_000) {
        return $tienLuong * 0.3 - 5_850_000;
    } elseif ($tienLuong > 80_000_000) {
        return $tienLuong * 0.35 - 9_850_000;
    }
    return 0;
}
$maPL = TaoMaPhieuLuong($ttNV['MaNV'], $date);
$nv = new NhanVien(
    $ttNV['MaNV'],
    $ttNV['GioiTinh'],
    $ttNV['SoCon'],
    $ttNV['HeSoLuong'],
);
if (isset($_POST['ghiChu'])) {
    $ghiChu = trim($_POST['ghiChu']);
} else $ghiChu = "";

if (isset($_POST['tienPhat'])) {
    $tienPhat = str_replace(".", "", $_POST['tienPhat']);
} else $tienPhat = $nv->TinhTienPhat($conn, $thang, $nam);

if (isset($_POST['tienThuong'])) {
    $tienThuong = str_replace(".", "", $_POST['tienThuong']);
} else $tienThuong = 0;
$soNgayCong = $nv->getSoNgayCong($conn, $thang, $nam);
$soNgayVang = $nv->getSoNgayVang($conn, $thang, $nam);
$luongTC = $nv->LuongTangCa($conn, $thang, $nam);
$tienTamUng = $nv->TienTamUng($conn, $thang, $nam);
$truBH = $nv->TruBaoHiem($conn, $thang, $nam);
$troCap = $nv->TinhTroCap();
$tienLuong = $nv->TinhTienLuong($conn, $thang, $nam);
$tongThuNhap = $tienLuong + $troCap + $tienThuong + $luongTC - $tienPhat;
if ($tongThuNhap > 11_000_000) {
    $thue = Thue($tongThuNhap - 11_000_000 - $truBH);
} else $thue = 0;
$thucLinh = $tongThuNhap - $thue - $tienTamUng - $truBH;

if (isset($_POST['tinh'])) {
    // if (!is_numeric($SoNgayCong)) {
    //     $err[] = "Vui lòng nhập số ngày công đúng định dạng số";
    // } else if ($SoNgayCong < 1 || $SoNgayCong > 31) {
    //     $err[] = "Số ngày công phải lớn hơn 1 và bé hơn 31";
    // }
    // if (!is_numeric($HeSoLuong)) {
    //     $err[] = "Vui lòng nhập hệ số lương đúng định dạng số";
    // }
    // if (!is_numeric($LuongTC)) {
    //     $err[] = "Vui lòng nhập số lương tăng ca đúng định dạng số";
    // }
    // if (!is_numeric($TienTamUng)) {
    //     $err[] = "Vui lòng nhập số tiền tạm ứng đúng định dạng số";
    // }
    // if (!is_numeric($Thue)) {
    //     $err[] = "Vui lòng nhập số tiền thuế đúng định dạng số";
    // }
    // if (!is_numeric($TruBH)) {
    //     $err[] = "Vui lòng nhập tiền bảo hiểm đúng định dạng số";
    // }
    $tongThuNhap = $tienLuong + $troCap + $tienThuong + $luongTC - $tienPhat - $truBH;
    if ($tongThuNhap > 11_000_000) {
        $thue = Thue($tongThuNhap - 11_000_000);
    } else $thue = 0;
    $thucLinh = $tongThuNhap - $thue - $tienTamUng;
}
if (isset($_POST['luu'])) {
    if($ghiChu!=""){
        $sqlInsertPL = "INSERT INTO `phieu_luong`(`MaPhieuLuong`, `MaNV`, `Thang`, `Nam`, `SoNgayCong`, `SoNgayVang`, `LuongTangCa`, `TienTamUng`,
                                             `Thue`, `TruBaoHiem`, `TroCap`, `Thuong`, `Phat`, `TienLuongThang`, `TongThuNhap`, `ThucLinh`, `GhiChu`) 
                                    VALUES ('$maPL','$ttNV[MaNV]','$thang','$nam','$soNgayCong','$soNgayVang','$luongTC','$tienTamUng',
                                            '$thue','$truBH','$troCap','$tienThuong','$tienPhat','$tienLuong','$tongThuNhap','$thucLinh','$ghiChu')";
    }
    else{
        $sqlInsertPL = "INSERT INTO `phieu_luong`(`MaPhieuLuong`, `MaNV`, `Thang`, `Nam`, `SoNgayCong`, `SoNgayVang`, `LuongTangCa`, `TienTamUng`,
                                             `Thue`, `TruBaoHiem`, `TroCap`, `Thuong`, `Phat`, `TienLuongThang`, `TongThuNhap`, `ThucLinh`, `GhiChu`) 
                                    VALUES ('$maPL','$ttNV[MaNV]','$thang','$nam','$soNgayCong','$soNgayVang','$luongTC','$tienTamUng',
                                            '$thue','$truBH','$troCap','$tienThuong','$tienPhat','$tienLuong','$tongThuNhap','$thucLinh',null)";
    }
    $resultInsertPL = mysqli_query($conn,$sqlInsertPL);
}

?>
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0">PHIẾU LƯƠNG NHÂN VIÊN</h5>
                <h5 class="mb-0"><?php echo "Tháng " . $_GET["thang"] . " năm " . $_GET["nam"]; ?></h5>
            </div>
            <div class="table-responsive">
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr>
                            <td>Mã phiếu lương:</td>
                            <td><input type="text" size="20" name="maPL" value="<?php echo $maPL; ?>" disabled /></td>
                            <td>Mã nhân viên:</td>
                            <td><input type="text" name="soCon" value="<?php echo $ttNV['MaNV']; ?> " disabled="disabled" /></td>
                        </tr>
                        <tr>
                            <td>Họ và tên:</td>
                            <td><input type="text" size="20" name="hoTen" value="<?php echo $ttNV["HoNV"] . " " . $ttNV["TenNV"]; ?>" disabled="disabled" /></td>
                            <td>Hệ số lương:</td>
                            <td><input type="text" disabled size="20" name="HeSoLuong" value="<?php echo $ttNV["HeSoLuong"]; ?>" /></td>
                        </tr>
                        <tr>
                            <td>Phòng:</td>
                            <td><input type="text" name="Phong" value="<?php echo $ttNV["TenPhong"]; ?> " disabled="disabled" /></td>
                            <td>Chức vụ</td>
                            <td><input type="text" size="20" name="ChucVu" value="<?php echo $ttNV["TenChucVu"]; ?>" disabled="disabled" /></td>
                        </tr>
                        <tr>
                            <td>Số ngày công</td>
                            <td><input type="text" disabled size="5" name="SoNgayCong" value="<?php echo $soNgayCong; ?>" /></td>
                            <td>Số ngày vắng</td>
                            <td><input type="text" disabled size="5" name="SoNgayVang" value="<?php echo $soNgayVang; ?>" /></td>
                        </tr>
                        <tr>
                            <td>Lương tăng ca:</td>
                            <td><input type="text" size="20" disabled name="luongTC" value="<?php echo MoneyFormat($luongTC); ?>" />VNĐ</td>
                            <td>Tiền tạm ứng:</td>
                            <td><input type="text" size="20" disabled name="tienTamUng" value="<?php echo MoneyFormat($tienTamUng); ?>" />VNĐ</td>
                        </tr>
                        <tr>
                            <td>Trợ cấp:</td>
                            <td><input type="text" size="20" name="troCap" value="<?php echo MoneyFormat($troCap); ?>" disabled />VNĐ</td>
                            <td>Trừ bảo hiểm:</td>
                            <td><input type="text" size="20" disabled name="truBh" value="<?php echo MoneyFormat($truBH); ?>" />VNĐ</td>
                        </tr>
                        <tr>
                            <td>Phạt:</td>
                            <td><input type="text" size="20" name="tienPhat" value="<?php echo  MoneyFormat($tienPhat); ?>" />VNĐ</td>
                            <td>Thưởng:</td>
                            <td><input type="text" size="20" name="tienThuong" value="<?php echo MoneyFormat($tienThuong); ?>">VNĐ</td>
                        </tr>
                        <tr>
                            <td>Tiền lương tháng:</td>
                            <td><input type="text" size="20" name="tienLuong" value="<?php echo MoneyFormat($tienLuong); ?>" disabled />VNĐ</td>
                            <td>Tổng thu nhập:</td>
                            <td><input type="text" size="20" name="tongThuNhap" value="<?php echo MoneyFormat($tongThuNhap); ?>" disabled />VNĐ</td>
                        </tr>
                        <tr>
                            <td>Thuế:</td>
                            <td><input type="text" size="20" disabled name="thue" value="<?php echo MoneyFormat($thue); ?>" />VNĐ</td>

                            <td>Thực lĩnh:</td>
                            <td><input type="text" size="20" name="thucLinh" value="<?php echo MoneyFormat($thucLinh); ?>" disabled />VNĐ</td>
                        </tr>
                        <tr>
                            <td>Ghi chú:</td>
                            <td id="no_color" colspan="3">
                                <div class="input-group input-group-lg">
                                    <input type="text" name="ghiChu" value="<?php echo $ghiChu;?>" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td id="no_color" colspan="2" align="center">
                                <input type="submit" value="Tính lương" name="tinh" class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" />
                            </td>
                            <td id="no_color" colspan="2" align="center">
                                <input type="submit" value="Lưu phiếu lương" name="luu" class="btn btn-outline-purple themnhanvien-btn mb-5 w-30" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->end(); ?>