
<?php $this->layout('layout_manager') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/'.explode('/', $_SERVER['PHP_SELF'])[1]."/models/NhanVien.php"); 
if (isset($_POST['hoNV']))
    $hoNV = trim($_POST['hoNV']);
else $hoNV = "";

if (isset($_POST['tenNV']))
    $tenNV = trim($_POST['tenNV']);
else $tenNV = "";

if (isset($_POST['soCon']))
    $soCon = trim($_POST['soCon']);
else $soCon = "";

if (isset($_POST['ngaySinh']))
    $ngaySinh = trim($_POST['ngaySinh']);
else $ngaySinh = "";

if (isset($_POST['maNV']))
    $maNV = trim($_POST['maNV']);
else $maNV = "";

if (isset($_POST['cccd']))
    $cccd = trim($_POST['cccd']);
else $cccd = "";

if (isset($_POST['stk']))
    $stk = trim($_POST['stk']);
else $stk = "";

if (isset($_POST['diaChi']))
    $diaChi = trim($_POST['diaChi']);
else $diaChi = "";

if (isset($_POST['phong']))
    $phong = trim($_POST['phong']);
else $phong = "";

if (isset($_POST['chucVu']))
    $chucVu = trim($_POST['chucVu']);
else $chucVu = "";

$tienLuong = "";
$troCap = "";
$tienThuong = "";
$tienPhat = "";
$thucLinh = "";
function MoneyFormat($tien)
{
    return number_format($tien, 0, ',', '.') . " VNĐ";
}
if (isset($_POST['tinh'])) {
    $gt = $_POST['radGT'];
    $nv = new NhanVien(
        $maNV,
        $hoNV,
        $tenNV,
        $gt,
        $ngaySinh,
        $diaChi,
        $stk,
        $cccd,
        $soCon,
        $phong,
        $chucVu
    );
    $conn = mysqli_connect('localhost', 'root', '', 'quan_ly_tien_luong')

        or die('Could not connect to MySQL: ' . mysqli_connect_error());

    $sql = "insert into nhan_vien(MaNV, HoNV, TenNV, GioiTinh, NgaySinh, DiaChi, MaPhong, STK, CCCD, MaChucVu, SoCon) 
            values('$maNV','$hoNV','$tenNV',$gt,'$ngaySinh','$diaChi','$phong','$stk','$cccd','$chucVu','$soCon')";

    $result = mysqli_query($conn, $sql);
}
?>
<form align='center' action="" method="post">

    <table>
        <thead>
            <th colspan="4" align="center">
                <h3>QUẢN LÝ NHÂN VIÊN</h3>
            </th>
        </thead>
        <tr>
            <td>Mã nhân viên:</td>
            <td><input type="text" size="40" name="maNV" value="<?php echo $maNV; ?> " /></td>
            <td>Số con:</td>
            <td><input type="text" name="soCon" value="<?php echo $soCon; ?> " /></td>
        </tr>
        <tr>
            <td>Họ :</td>
            <td><input type="text" size="40" name="hoNV" value="<?php echo $hoNV; ?> " /></td>
            <td>Tên:</td>
            <td><input type="text" name="tenNV" value="<?php echo $tenNV; ?> " /></td>
        </tr>
        <tr>
            <td>Phòng:</td>
            <td><input type="text" size="40" name="phong" value="<?php echo $phong; ?> " /></td>
            <td>Chức Vụ:</td>
            <td><input type="text" name="chucVu" value="<?php echo $chucVu; ?> " /></td>
        </tr>
        <tr>
            <td>Ngày sinh:</td>
            <td><input type="date" name="ngaySinh" value="<?php echo $ngaySinh; ?> " /></td>
            <td>CCCD:</td>
            <td><input type="text" name="cccd" value="<?php echo $cccd; ?> " /></td>
        </tr>
        <tr>
            <td>Giới tính:</td>
            <td>
                <input type="radio" name="radGT" value="1" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == '1') echo 'checked="checked"'; ?> checked />Nam
                <input type="radio" name="radGT" value="0" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == '0') echo 'checked="checked"'; ?> />Nữ
            </td>
            <td>STK</td>
            <td><input type="text" name="stk" value="<?php echo $stk; ?> " /></td>
        </tr>
        <tr>
            <td colspan="2"> Địa chỉ:</td>
            <td colspan="2" align="center">
                <input type="text" name="diaChi" value="<?php echo $diaChi; ?> " />
            </td>
        </tr>
        <tr>
            <td id="no_color" colspan="4" align="center">
                <input type="submit" value="Tính lương" name="tinh" />
            </td>
        </tr>
        <!-- <tr>
                    <td align="center">Tiền lương:</td>
			        <td align="center"><input type="text" disabled="disabled" name="tienLuong" value="<?php if ($tienLuong != "") echo MoneyFormat($tienLuong);
                                                                                                        else echo ""; ?> "/></td>
                    <td align="center">Trợ cấp:</td>
                    <td><input type="text" disabled="disabled" name="troCap" value="<?php if ($troCap != "") echo MoneyFormat($troCap);
                                                                                    else echo ""; ?> "/></td>
			    </tr>
                <tr>
                    <td align="center">Tiền thưởng:</td>
			        <td align="center"><input type="text" disabled="disabled"  name="tienThuong" value="<?php if ($tienThuong != "") echo MoneyFormat($tienThuong);
                                                                                                        else echo ""; ?> "/></td>
                    <td align="center">Tiền phạt:</td>
                    <td><input type="text" disabled="disabled" name="tienPhat" value="<?php if ($tienPhat != "" && $tienPhat > 0) echo MoneyFormat($tienPhat);
                                                                                        else echo ""; ?> "/></td>
			    </tr>
                </tr>
			        <td colspan="4" align="center">
					    Thực lĩnh: <input type="text" disabled="disabled" name="thucLinh" value="<?php if ($thucLinh != "") echo MoneyFormat($thucLinh);
                                                                                                    else echo ""; ?> "/>
				    </td>
			    </tr> -->
    </table>
</form>
<?php $this->end(); ?>