<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once($_SERVER['DOCUMENT_ROOT'].'/'.explode('/', $_SERVER['PHP_SELF'])[1]."/connect.php"); 
$sqlTT = "select nhan_vien.*, TenChucVu, TenPhong from nhan_vien, chuc_vu, phong_ban 
        where nhan_vien.MaPhong = phong_ban.MaPhong 
        and nhan_vien.MaChucVu = chuc_vu.MaChucVu
        and MaNV = '$_SESSION[MaNV]'";
$resultTT = mysqli_query($conn, $sqlTT);
if (mysqli_num_rows($resultTT) > 0) {
    $TT = mysqli_fetch_array($resultTT);
}
if($TT["GioiTinh"] == 1) $gt = "Nam";
else $gt = "Nữ";
?>
<div class="row p-5">
<table class="col-6">
    <tr>
        <td class="title">Mã nhân viên:</td>
        <td><?= $TT["MaNV"] ?></td>
    </tr>
    <tr>
        <td class="title">Họ tên:</td>
        <td><?= $TT["HoNV"] . " " . $TT["TenNV"] ?></td>
    </tr>
    <tr>
        <td class="title">Giới tính:</td>
        <td><?= $gt ?></td>
    </tr>
    <tr>
        <td class="title">Phòng:</td>
        <td><?= $TT["TenPhong"] ?></td>
    </tr>
    <tr>
        <td class="title">Chức vụ:</td>
        <td><?= $TT["TenChucVu"] ?></td>
    </tr>
</table>
<table class="col-6">
    <tr>
        <td class="title">Ngày sinh:</td>
        <td><?= $TT["NgaySinh"] ?></td>
    </tr>
    <tr>
        <td class="title">Số điện thoại:</td>
        <td><?= $TT["SDT"] ?></td>
    </tr>
    <tr>
        <td class="title">Địa chỉ:</td>
        <td><?= $TT["DiaChi"] ?></td>
    </tr>
    <tr>
        <td class="title">CCCD:</td>
        <td><?= $TT["CCCD"] ?></td>
    </tr>
    <tr>
        <td class="title">Số tài khoản</td>
        <td><?= $TT["STK"] ?></td>
    </tr>
    <tr>
        <td class="title">Số con</td>
        <td><?= $TT["SoCon"] ?></td>
    </tr>
</table>
</div>