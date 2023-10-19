<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<table class="info">
    <tr>
        <td>Mã nhân viên</td>
        <td><?= $_SESSION["MaNV"] ?></td>
    </tr>
    <tr>
        <td>Giới tính</td>
        <td>Nam</td>
    </tr>
    <tr>
        <td>Chức vụ</td>
        <td>Giám đốc</td>
    </tr>
    <tr>
        <td>Phòng</td>
        <td>Điều hành</td>
    </tr>
    <tr>
        <td>Số điện thoại</td>
        <td>0976731371</td>
    </tr>
</table>
<table>
    <tr>
        <td>Mã nhân viên</td>
        <td><?= $_SESSION["MaNV"] ?></td>
    </tr>
    <tr>
        <td>Giới tính</td>
        <td>Nam</td>
    </tr>
    <tr>
        <td>Chức vụ</td>
        <td>Giám đốc</td>
    </tr>
    <tr>
        <td>Phòng</td>
        <td>Điều hành</td>
    </tr>
    <tr>
        <td>Số điện thoại</td>
        <td>0976731371</td>
    </tr>
</table>