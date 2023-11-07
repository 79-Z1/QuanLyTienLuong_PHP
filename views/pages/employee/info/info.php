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
<form action="" method="post" id="form-change-pass" name="form-change-pass">
    <div class="modal fade" id="doimatkhau" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Đổi mật khẩu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <b>Tên tài khoản</b>
                    <input class="form-control py-2" type="text" size="20" name="tenTK" value="<?= $TT['MaNV'] ?>" disabled="disabled" />

                    <b id="oldPass-err">Mật khẩu cũ</b>
                    <input class="form-control py-2" id="oldPass" type="password" size="20" name="oldPass" />

                    <b id="newPass-err">Mật khẩu mới</b>
                    <input class="form-control py-2" id="newPass" type="password" size="20" name="newPass" />

                    <b id="reNewPass-err">Nhập lại mật khẩu mới</b>
                    <input class="form-control py-2" id="reNewPass" type="password" size="20" name="reNewPass"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <input id="change" class="btn btn-danger" type="submit" value="Đổi mật khẩu" name="change" />
                </div>
            </div>
        </div>
    </div>
</form>
<div class="table-responsive">
    <div class='d-flex justify-content-end'>
        <input class="btn btn-outline-purple" type="submit" value="Đổi mật khẩu" data-bs-toggle="modal" data-bs-target="#doimatkhau" />
        <button class="btn btn-outline-danger ms-3" id="btn-logout">
            <i class="bi bi-box-arrow-right"></i>
            Đăng xuất
        </button>
    </div>
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