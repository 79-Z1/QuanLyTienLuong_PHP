<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
$sqlTT = "select nhan_vien.*, TenChucVu, TenPhong, HeSoLuong from nhan_vien, chuc_vu, phong_ban 
        where nhan_vien.MaPhong = phong_ban.MaPhong 
        and nhan_vien.MaChucVu = chuc_vu.MaChucVu
        and MaNV = '$_SESSION[MaNV]'";
$resultTT = mysqli_query($conn, $sqlTT);
if (mysqli_num_rows($resultTT) > 0) {
    $TT = mysqli_fetch_array($resultTT);
}
if ($TT["GioiTinh"] == 1) $gt = "Nam";
else $gt = "Nữ";
?>
<div class="table-responsive">
    <table id="info" class="table table-hover table-nowrap">
        <tr>
            <td class="title left">Mã nhân viên:</td>
            <td><?= $TT["MaNV"] ?></td>
            <td class="title  ">Họ tên:</td>
            <td><?= $TT["HoNV"] . " " . $TT["TenNV"] ?></td>
        </tr>
        <tr>
            <td class="title left">Phòng:</td>
            <td><?= $TT["TenPhong"] ?></td>
            <td class="title ">Chức vụ:</td>
            <td><?= $TT["TenChucVu"] ?></td>
        </tr>
        <tr>
            <td class="title left">Giới tính:</td>
            <td><?= $gt ?></td>
            <td class="title ">Ngày sinh:</td>
            <td><?= $TT["NgaySinh"] ?></td>
        </tr>
        <tr>
            <td class="title left">Hệ số lương:</td>
            <td><?= $TT["HeSoLuong"] ?></td>
            <td class="title">Số con:</td>
            <td><?= $TT["SoCon"] ?></td>
        </tr>
        <tr>
            <td class="title left">Số điện thoại:</td>
            <td><?= $TT["SDT"] ?></td>
            <td class="title ">Địa chỉ:</td>
            <td><?= $TT["DiaChi"] ?></td>
        </tr>
        <tr>
            <td class="title left">Số tài khoản:</td>
            <td><?= $TT["STK"] ?></td>

            <td class="title ">CCCD:</td>
            <td><?= $TT["CCCD"] ?></td>
        </tr>
    </table>
</div>