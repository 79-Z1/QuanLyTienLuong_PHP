<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Trang Nhập liệu</title>
    <style>
        /* CSS cho form */
        form {
            width: 400px;
            margin: 0 auto;
            background-color: aqua;

        }

        p {
            font-size: 20px;
        }

        tr td {
            font-size: 20px !important;
            height: 20% !important;
            font-weight: bold;
            padding: 10px 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_POST['hoTen'])) {
        $hoTen = trim($_POST['hoTen']);
    } else $hoTen = "";
    if (isset($_POST['diaChi'])) {
        $diaChi = trim($_POST['diaChi']);
    } else $diaChi = "";
    if (isset($_POST['SDT'])) {
        $SDT = trim($_POST['SDT']);
    } else $SDT = "";
    if (isset($_POST['gioiTinh'])) {
        $gioiTinh = trim($_POST['gioiTinh']);
    } else $gioiTinh = "";
    if (isset($_POST['quocTich'])) {
        $quocTich = trim($_POST['quocTich']);
    } else $quocTich = "";
    if (isset($_POST['monHoc'])) {
        $monHoc = trim($_POST['monHoc']);
    } else $monHoc = "";
    if (isset($_POST['ghiChu'])) {
        $ghiChu = trim($_POST['ghiChu']);
    } else $ghiChu = "";
    ?>
    <h2>Enter your information</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <table>
            <tbody>
                <tr>
                    <td>
                        <p>Họ và tên</p>
                    </td>
                    <td><input type="text" name="hoTen" value="<?php echo $hoTen ?>"></td>
                </tr>
                <tr>
                    <td>
                        <p>Địa chỉ</p>
                    </td>
                    <td><input type="text" name="diaChi" value="<?php echo $diaChi ?>"></td>
                </tr>
                <tr>
                    <td>
                        <p>Số điện thoại</p>
                    </td>
                    <td><input type="text" name="SDT" value="<?php echo $SDT ?>"></td>
                </tr>
                <tr>
                    <td>
                        <p>Giới tính</p>
                    </td>
                    <td>
                        <div style="display: flex; justify-content:space-between; font-size: 18px;">
                            <input type="radio" name="radGT" id="nam" value="1" <?php echo "$gioiTinh checked" ?>>
                            <label for="nam">
                                Nam
                            </label>
                            <input type="radio" name="radGT" id="nu" value="0" <?php echo "$gioiTinh checked" ?>>
                            <label for="nu">
                                Nữ
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Quốc tịch</p>
                    </td>
                    <td>
                        <select name="quocTich">
                            <option value="<?php echo $quocTich ?>">Việt Nam</option>
                            <option value="<?php echo $quocTich ?>">Trung Quốc</option>
                            <option value="<?php echo $quocTich ?>">Hàn Quốc</option>
                            <option value="<?php echo $quocTich ?>">Nhật Bản</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Các môn đã học</p>
                    </td>
                    <td>
                        <label><input type="radio" name="monhoc" value="" checked> PHP & MySQL</label>
                        <label><input type="radio" name="monhoc" value=""> C#</label>
                        <label><input type="radio" name="monhoc" value=""> XML</label>
                        <label><input type="radio" name="monhoc" value=""> Python</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Ghi chú</p>
                    </td>
                    <td id="no_colo" r>
                        <div class="input-group input-group-lg">
                            <textarea class="form-control" name="ghiChu" maxlength="300"> <?php echo $ghiChu; ?></textarea>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</body>

</html>
<?php $this->end(); ?>