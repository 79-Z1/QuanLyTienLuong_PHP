<?php $this->layout('layout_accountant') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

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

function LuongTangCa($conn, $maNV, $thang, $nam, $luongTheoGio){
    $tienTC = 0;
    $sql = "SELECT LoaiTC FROM `tang_ca` WHERE MaNV = '$maNV' and month(NgayTC) = $thang and year(NgayTC) = $nam";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) <> 0){
        while($row = mysqli_fetch_array($result)){
            if($row["LoaiTC"] == 0){
                $tienTC += ($luongTheoGio * 1.5 + $luongTheoGio * 0.3 + 0.2 * ($luongTheoGio * 1.5)) * 4;
            }
            else if($row["LoaiTC"] == 1){
                $tienTC += ($luongTheoGio * 2 + $luongTheoGio * 0.3 + 0.2 * ($luongTheoGio * 2)) * 4;
            }
            else {
                $tienTC += ($luongTheoGio * 3 + $luongTheoGio * 0.3 + 0.2 * ($luongTheoGio * 3)) * 4;
            }
        }
    }
    return $tienTC;
}

function TienTamUng($conn, $maNV, $thang, $nam){
    $sql = "SELECT SoTien FROM `phieu_ung_luong` WHERE MaNV = '$maNV' and month(NgayUng) = $thang and year(NgayUng) = $nam and Duyet = 1";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) != 0){
        $row = mysqli_fetch_array($result);
        return $row['SoTien'];
    }
    else{
        return 0;
    }
   
}

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

$maPL = TaoMaPhieuLuong($ttNV['MaNV'], $date);


$luongToiThieuVung = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS001'"))['GiaTri'];
$troCapXang = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS002'"))['GiaTri'];
$troCapCon = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS003'"))['GiaTri'];
$dinhMucVang = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS004'"))['GiaTri'];
$donGiaPhat = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS005'"))['GiaTri'];
$phanTramBH = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS006'"))['GiaTri'] / 100;
$mucLuongThue = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS007'"))['GiaTri'];

$luongTheoGio = $luongToiThieuVung * $ttNV['HeSoLuong'] / 30 / 8;
$luongTheoNgay = $luongToiThieuVung * $ttNV['HeSoLuong'] / 30;
$luongTT = $luongToiThieuVung * $ttNV['HeSoLuong'];

$soNgayCong = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(MaCong) as SoNgayCong FROM `cham_cong` where MaNV = '$ttNV[MaNV]' and month(Ngay) = $thang and year(Ngay) = $nam and (TinhTrang = 1 or NghiHL = 1)"))['SoNgayCong'];

$soVang = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(MaCong) - 4 as SoNgayVang FROM `cham_cong` where MaNV = '$ttNV[MaNV]' and month(Ngay) = $thang and year(Ngay) = $nam and TinhTrang = 0 and NghiHL = 0"))['SoNgayVang'];
$soNgayVang = $soVang < 0 ? 0 : $soVang;

$tienLuong = $luongTheoNgay * $soNgayCong;
$troCap = $ttNV['GioiTinh'] == "0" ? $troCapCon * $ttNV['SoCon'] * 1.5 + $troCapXang : $troCapCon * $ttNV['SoCon'] + $troCapXang;
$truBH = $tienLuong * $phanTramBH;
$tienPhat = $soNgayVang > $dinhMucVang ? ($soNgayVang - $dinhMucVang) * $donGiaPhat : 0;

$luongTC = LuongTangCa($conn, $ttNV['MaNV'], $thang, $nam, $luongTheoGio);
$tienTamUng = TienTamUng($conn, $ttNV['MaNV'], $thang, $nam);

if (isset($_POST['ghiChu'])) {
    $ghiChu = trim($_POST['ghiChu']);
}else $ghiChu = '';


if (isset($_POST['tienPhat'])) {
    if(!is_numeric(intval($_POST['tienPhat']))){
        $tienPhat = 0;
        $err[] = "Vui lòng nhập tiền phạt đúng định dạng số";
    } else $tienPhat = str_replace(".", "", $_POST['tienPhat']);
}

if (isset($_POST['tienThuong'])) {
    if(!is_numeric(intval($_POST['tienThuong']))){
        $tienThuong = 0;
        $err[] = "Vui lòng nhập tiền thưởng đúng định dạng số";
    }else $tienThuong = str_replace(".", "", $_POST['tienThuong']);
}

$tongThuNhap = $tienLuong + $troCap + $tienThuong + $luongTC - $tienPhat - $truBH;

if ($tongThuNhap > $mucLuongThue) {
    $thue = Thue($tongThuNhap - $mucLuongThue, $conn);
} else $thue = 0;
$thucLinh = $tongThuNhap - $thue - $tienTamUng;

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
                            <td>Mã phiếu lương</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maPL" value="<?php echo $maPL; ?>" disabled /></td>
                            <td>Mã nhân viên</td>
                            <td><input class="form-control-left p-2" type="text" name="soCon" value="<?php echo $ttNV['MaNV']; ?> " disabled="disabled" /></td>
                        </tr>
                        <tr>
                            <td>Họ và tên</td>
                            <td><input class="form-control-name py-2" type="text" size="20" name="hoTen" value="<?php echo $ttNV["HoNV"] . " " . $ttNV["TenNV"]; ?>" disabled="disabled" /></td>
                            <td>Hệ số lương</td>
                            <td><input class="form-control-salary p-2" type="text" disabled size="20" name="HeSoLuong" value="<?php echo $ttNV["HeSoLuong"]; ?>" /></td>
                        </tr>
                        <tr>
                            <td>Phòng</td>
                            <td><input class="form-control-room py-2" type="text" name="Phong" value="<?php echo $ttNV["TenPhong"]; ?> " disabled="disabled" /></td>
                            <td>Chức vụ</td>
                            <td><input class="form-control py-2" type="text" size="20" name="ChucVu" value="<?php echo $ttNV["TenChucVu"]; ?>" disabled="disabled" /></td>
                        </tr>
                        <tr>
                            <td>Số ngày công</td>
                            <td><input class="form-control-date py-2" type="text" disabled size="5" name="SoNgayCong" value="<?php echo $soNgayCong; ?>" /></td>
                            <td>Số ngày vắng</td>
                            <td><input class="form-control-date py-2" type="text" disabled size="5" name="SoNgayVang" value="<?php echo $soNgayVang; ?>" /></td>
                        </tr>
                        <tr>
                            <td>Lương tăng ca</td>
                            <td><input class="td-control p-2" type="text" size="20" disabled name="luongTC" value="<?php echo MoneyFormat($luongTC); ?>" />VNĐ</td>
                            <td>Tiền tạm ứng</td>
                            <td><input class="td-control p-2" type="text" size="20" disabled name="tienTamUng" value="<?php echo MoneyFormat($tienTamUng); ?>" />VNĐ</td>
                        </tr>
                        <tr>
                            <td>Trợ cấp</td>
                            <td><input class="td-control p-2" type="text" size="20" name="troCap" value="<?php echo MoneyFormat($troCap); ?>" disabled />VNĐ</td>
                            <td>Trừ bảo hiểm</td>
                            <td><input class="td-control p-2" type="text" size="20" disabled name="truBh" value="<?php echo MoneyFormat($truBH); ?>" />VNĐ</td>
                        </tr>
                        <tr>
                            <td>Phạt</td>
                            <td><input class="td-control p-2" onchange="handleChange(this);" style="background-color: #FFF;" type="text" size="20" name="tienPhat" value="<?php echo MoneyFormat($tienPhat); ?>" />VNĐ</td>
                            <td>Thưởng</td>
                            <td><input class="td-control p-2" onchange="handleChange(this);"  style="background-color: #FFF;" type="text" size="20" name="tienThuong" value="<?php echo MoneyFormat($tienThuong); ?>">VNĐ</td>
                        </tr>
                        <tr>
                            <td>Tiền lương tháng</td>
                            <td><input class="td-control p-2" type="text" size="20" name="tienLuong" value="<?php echo MoneyFormat($tienLuong); ?>" disabled />VNĐ</td>
                            <td>Tổng thu nhập</td>
                            <td><input class="td-control p-2" type="text" size="20" name="tongThuNhap" value="<?php echo MoneyFormat($tongThuNhap); ?>" disabled />VNĐ</td>
                        </tr>
                        <tr>
                            <td>Thuế</td>
                            <td><input class="td-control p-2" type="text" size="20" disabled name="thue" value="<?php echo MoneyFormat($thue); ?>" />VNĐ</td>

                            <td>Thực lĩnh</td>
                            <td><input class="td-control p-2" type="text" size="20" name="thucLinh" value="<?php echo MoneyFormat($thucLinh); ?>" disabled />VNĐ</td>
                        </tr>
                        <tr>
                            <td>Ghi chú</td>
                            <td id="no_colo" r>
                                <div class="input-group input-group-lg">
                                    <textarea class="form-control" name="ghiChu" rows="3" maxlength="300"> <?php echo $ghiChu; ?></textarea>
                                </div>
                            </td>
                            <td id="no_color" align="center">
                                <input type="submit" value="Tính lương" id='tinhluong' name="tinh" class="btn btn-outline-purple themnhanvien-btn w-60" />
                            </td>
                            <td id="no_color" align="center">
                                <input type="submit" value="Lưu phiếu lương" id='luupl' onclick="thongBao('<?=$_GET['thang']?>','<?=$_GET['MaNV']?>')" name="luu" class="btn btn-outline-purple themnhanvien-btn w-30" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['luu'])) {
    $tienThuong =  str_replace("", ".", $tienThuong);
    if ($ghiChu != "") {
        $sqlInsertPL = "INSERT INTO `phieu_luong`(`MaPhieuLuong`, `MaNV`, `Thang`, `Nam`, `SoNgayCong`, `SoNgayVang`, `LuongTangCa`, `TienTamUng`,
                                                 `Thue`, `TruBaoHiem`, `TroCap`, `Thuong`, `Phat`, `TienLuongThang`, `TongThuNhap`, `ThucLinh`, `GhiChu`) 
                                        VALUES ('$maPL','$ttNV[MaNV]','$thang','$nam','$soNgayCong','$soNgayVang','$luongTC','$tienTamUng',
                                                '$thue','$truBH','$troCap','$tienThuong','$tienPhat','$tienLuong','$tongThuNhap','$thucLinh','$ghiChu')";
    } else {
        $sqlInsertPL = "INSERT INTO `phieu_luong`(`MaPhieuLuong`, `MaNV`, `Thang`, `Nam`, `SoNgayCong`, `SoNgayVang`, `LuongTangCa`, `TienTamUng`,
                                                 `Thue`, `TruBaoHiem`, `TroCap`, `Thuong`, `Phat`, `TienLuongThang`, `TongThuNhap`, `ThucLinh`, `GhiChu`) 
                                        VALUES ('$maPL','$ttNV[MaNV]','$thang','$nam','$soNgayCong','$soNgayVang','$luongTC','$tienTamUng',
                                                '$thue','$truBH','$troCap','$tienThuong','$tienPhat','$tienLuong','$tongThuNhap','$thucLinh',null)";
    }
    $resultInsertPL = mysqli_query($conn, $sqlInsertPL);
    echo "<script type='text/javascript'>
                $('#tinh').prop('disabled','disabled');
                $('#luu').prop('disabled','disabled');
                toastr.success('Phiếu lương tháng $thang năm $nam <br> Nhân viên $ttNV[HoNV] $ttNV[TenNV] <br> Đã được lưu thành công!');
                setTimeout(function() {
                    window.location.href = '/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/accountant?page=accountant-payroll&p=$_GET[p]" . "';
                }, 3000);
            </script>";
}
?>
<?php $this->end(); ?>