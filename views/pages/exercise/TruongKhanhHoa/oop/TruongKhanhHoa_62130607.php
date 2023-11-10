<!-- <!-- <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        form {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        fieldset {
            background-color: #eeeeee;
            width: fit-content;
        }

        legend {
            background-color: gray;
            color: white;
            padding: 5px 10px;
        }

        input {
            margin: 5px;
        }
    </style>
</head>
<?php

if (isset($_POST['tinh'])) {
    if (!empty($_POST['hovaten']) && !empty($_POST['socon']) && !empty($_POST['ngaysinh']) && !empty($_POST['ngayvaolam']) && !empty($_POST['hesoluong'])) {
        $hovaten = $_POST['hovaten'];
        $socon = $_POST['socon'];
        $ngaysinh = $_POST['ngaysinh'];
        $ngayvaolam = $_POST['ngayvaolam'];
        $gioitinh = $_POST['gioitinh'];
        $hesoluong = $_POST['hesoluong'];
        $loainhanvien = $_POST['loainhanvien'];
        if (
            isset($_POST['socon']) && is_numeric($_POST['socon']) &&
            isset($_POST['hesoluong']) && is_numeric($_POST['hesoluong'])
        ) {
            if (isset($_POST['loainhanvien']) &&  ($_POST['loainhanvien']) == "vanphong") {
                if (!empty($_POST['songayvang'])) {
                    if (is_numeric($_POST['songayvang'])) {
                        $songayvang = $_POST['songayvang'];
                        $nvvp = new NhanVieVanPhong($hovaten, $gioitinh, $ngayvaolam, $hesoluong, $socon, $songayvang);
                        $tienthuong = $nvvp->tinh_tien_thuong();
                        $trocap = $nvvp->tinh_tro_cap();
                        $tienphat = $nvvp->tinh_tien_phat();
                        $tienluong = $nvvp->tinh_tien_luong();
                        $thuclinh = $tienthuong + $trocap + $tienluong - $tienphat;
                    } else echo "<h3 style='color: red'>Vui lòng nhập vào số!!!</h3>";
                } else echo "<h3 style='color: red'>Vui lòng nhập đầy đủ thông tin!!!</h3>";
            }
            if (isset($_POST['loainhanvien']) &&  ($_POST['loainhanvien']) == "sanxuat") {
                if (!empty($_POST['sosanpham'])) {
                    if (is_numeric($_POST['sosanpham'])) {
                        $sosanpham = $_POST['sosanpham'];
                        $nvsx = new NhanVienSanXuat($hovaten, $gioitinh, $ngayvaolam, $hesoluong, $socon, $sosanpham);
                        $tienthuong = $nvsx->tinh_tien_thuong();
                        $trocap = $nvsx->tinh_tro_cap();
                        $tienluong = $nvsx->tinh_tien_luong();
                        $thuclinh = $tienthuong + $trocap + $tienluong;
                    } else echo "<h3 style='color: red'>Vui lòng nhập vào số!!!</h3>";
                } else echo "<h3 style='color: red'>Vui lòng nhập đầy đủ thông tin!!!</h3>";
            }
        } else echo "<h3 style='color: red'>Vui lòng nhập vào số!!!</h3>";
    } else echo "<h3 style='color: red'>Vui lòng nhập đầy đủ thông tin!!!</h3>";
} else {
}
?> -->
<form action="" method="post">
    <fieldset>
        <legend>QUẢN LÝ NHÂN VIÊN</legend>
        <table>
            <tr>
                <td>Họ và tên:</td>
                <td>
                    <input type="text" name="hovaten" value="<?php if (isset($_POST['hovaten'])) echo $_POST['hovaten']; ?>" />
                </td>
                <td></td>
                <td>Số con:</td>
                <td>
                    <input type="text" name="socon" value="<?php if (isset($_POST['socon'])) echo $_POST['socon']; ?>" />
                </td>
            </tr>
            <tr>
                <td>Ngày sinh:</td>
                <td>
                    <input type="date" name="ngaysinh" value="<?php if (isset($_POST['ngaysinh'])) echo $_POST['ngaysinh']; ?>" />
                </td>
                <td></td>
                <td>Ngày vào làm:</td>
                <td>
                    <input type="date" name="ngayvaolam" value="<?php if (isset($_POST['ngayvaolam'])) echo $_POST['ngayvaolam']; ?>" />
                </td>
            </tr>
            <tr>
                <td>Giới tính:</td>
                <td>
                    <input type="radio" name="gioitinh" value="Nam" <?php if (isset($_POST['gioitinh']) && ($_POST['gioitinh']) == "Nam") echo 'checked' ?> checked />Nam
                    <input type="radio" name="gioitinh" value="Nữ" <?php if (isset($_POST['gioitinh']) && ($_POST['gioitinh']) == "Nữ") echo 'checked' ?> />Nữ
                </td>
                <td></td>
                <td>Hệ số lương:</td>
                <td>
                    <input type="text" name="hesoluong" value="<?php if (isset($_POST['hesoluong'])) echo $_POST['hesoluong']; ?>" />
                </td>
            </tr>
            <tr>
                <td>Loại nhân viên:</td>
                <td>
                    <input type="radio" name="loainhanvien" value="vanphong" <?php if (isset($_POST['loainhanvien']) && ($_POST['loainhanvien']) == "vanphong") echo 'checked' ?> checked />Văn phòng
                </td>

                <td></td>
                <td>
                    <input type="radio" name="loainhanvien" value="sanxuat" <?php if (isset($_POST['loainhanvien']) && ($_POST['loainhanvien']) == "sanxuat") echo 'checked' ?> />Sản xuất
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    Số ngày vắng:
                    <input type="text" name="songayvang" value="<?php if (isset($_POST['songayvang'])) echo $_POST['songayvang']; ?>" />
                </td>
                <td></td>
                <td>Số sản phẩm:</td>
                <td>
                    <input type="text" name="sosanpham" value="<?php if (isset($_POST['sosanpham'])) echo $_POST['sosanpham']; ?>" />
                </td>
            </tr>
            <tr>
                <td colspan="5" align="center"><input type="submit" name="tinh" value="Tính lương" /></td>
            </tr>
            <tr>
                <td>Tiền lương:</td>
                <td>
                    <input type="text" value="<?php if (isset($tienluong)) echo number_format($tienluong) . " VNĐ"; ?>" disabled />
                </td>
                <td></td>
                <td>Trợ cấp:</td>
                <td>
                    <input type="text" value="<?php if (isset($trocap)) echo number_format($trocap) . " VNĐ"; ?>" disabled />
                </td>
            </tr>
            <tr>
                <td>Tiền thưởng:</td>
                <td>
                    <input type="text" value="<?php if (isset($tienthuong)) echo number_format($tienthuong) . " VNĐ"; ?>" disabled />
                </td>
                <td></td>
                <td>Tiền phạt:</td>
                <td>
                    <input type="text" value="<?php if (isset($tienphat)) echo number_format($tienphat) . " VNĐ"; ?>" disabled />
                </td>
            </tr>
            <tr>
                <td colspan="5" align="center">Thực lĩnh: <input type="text" value="<?php if (isset($thuclinh)) echo number_format($thuclinh) . " VNĐ"; ?>" disabled /></td>
            </tr>
        </table>
    </fieldset>
</form>
</body>

</html> -->