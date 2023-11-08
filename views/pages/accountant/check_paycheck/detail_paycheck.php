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

$ttNV = mysqli_fetch_array($result);


$sqlgetTTPL = "select * from phieu_luong where MaPhieuLuong = '$maPL'";

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

function MoneyFormat($tien)
{
    return number_format($tien, 0, ',', '.');
}

?>
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header d-flex justify-content-between">
                <h3 class="mb-0">THÔNG TIN PHIẾU LƯƠNG NHÂN VIÊN</h3>
                <h3 class="mb-0"><?php echo "Tháng " . $thang . " năm " . $nam; ?></h3>
            </div>
            <div class="table-responsive">
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr>
                            <td class="label-info"><b>Mã phiếu lương:</b></td>
                            <td class="info"><?php echo $maPL; ?></td>
                            <td class="label-info-right"><b>Mã nhân viên:</b></td>
                            <td class="info-right"><?php echo $ttNV['MaNV']; ?></td>
                        </tr>
                        <tr>
                            <td class="label-info"><b>Họ và tên:</b></td>
                            <td class="info"><?php echo $ttNV["HoNV"] . " " . $ttNV["TenNV"]; ?></td>
                            <td class="label-info-right"><b>Hệ số lương:</b></td>
                            <td class="info-right"><?php echo $ttNV["HeSoLuong"]; ?></td>
                        </tr>
                        <tr>
                            <td class="label-info"><b>Phòng:</b></td>
                            <td class="info"><?php echo $ttNV["TenPhong"]; ?></td>
                            <td class="label-info-right"><b>Chức vụ:</b></td>
                            <td class="info-right"><?php echo $ttNV["TenChucVu"]; ?></td>
                        </tr>
                        <tr>
                            <td class="label-info"><b>Số ngày công:</b></td>
                            <td class="info"><?php echo $soNgayCong; ?></td>
                            <td class="label-info-right"><b>Số ngày vắng:</b></td>
                            <td class="info-right"><?php echo $soNgayVang; ?></td>
                        </tr>
                        <tr>
                            <td class="label-info"><b>Lương tăng ca:</b></td>
                            <td class="info"><?php echo MoneyFormat($luongTC); ?> VNĐ</td>
                            <td class="label-info-right"><b>Tiền tạm ứng:</b></td>
                            <td class="info-right"><?php echo MoneyFormat($tienTamUng); ?> VNĐ</td>
                        </tr>
                        <tr>
                            <td class="label-info"><b>Trợ cấp:</b></td>
                            <td class="info"><?php echo MoneyFormat($troCap); ?> VNĐ</td>
                            <td class="label-info-right"><b>Trừ bảo hiểm:</b></td>
                            <td class="info-right"><?php echo MoneyFormat($truBH); ?> VNĐ</td>
                        </tr>
                        <tr>
                            <td class="label-info"><b>Phạt:</b></td>
                            <td class="info"><?php echo  MoneyFormat($tienPhat); ?> VNĐ</td>
                            <td class="label-info-right"><b>Thưởng:</b></td>
                            <td class="info-right"><?php echo MoneyFormat($tienThuong); ?> VNĐ</td>
                        </tr>
                        <tr>
                            <td class="label-info"><b>Tiền lương tháng:</b></td>
                            <td class="info"><?php echo MoneyFormat($tienLuong); ?> VNĐ</td>
                            <td class="label-info-right"><b>Tổng thu nhập:</b></td>
                            <td class="info-right"><?php echo MoneyFormat($tongThuNhap); ?> VNĐ</td>
                        </tr>
                        <tr>
                            <td class="label-info"><b>Thuế:</b></td>
                            <td class="info"><?php echo MoneyFormat($thue); ?> VNĐ</td>

                            <td class="label-info-right"><b>Thực lĩnh:</b></td>
                            <td class="info-right"><?php echo MoneyFormat($thucLinh); ?> VNĐ</td>
                        </tr>
                        <tr align="center">
                            <td colspan="4">
                            <b style="font-size: 1.4rem !important;">Ghi chú:</b>
                            <div class="text-area input-group input-group-lg">
                                <textarea class="form-control" name="ghiChu" rows="3" maxlength="300" readonly> <?php if(isset($_POST['ghiChu']))echo htmlentities ($_POST['ghiChu']); else echo $ghiChu;?> </textarea>
                            </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="option-buttons d-flex justify-content-between">
            <input onclick="history.back()" class="btn btn-info" type="submit" value="Quay lại" />
        </div>
    </div>
</div>
<?php $this->end(); ?>