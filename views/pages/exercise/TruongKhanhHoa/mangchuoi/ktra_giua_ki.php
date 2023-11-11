<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<style>
    form {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    fieldset {
        background-color: #eeeeee;
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
<?php
function read_from_file()
{
    $result = "";
    $lines = file('TruongKhanhHoa_62130607.dat');
    foreach ($lines as $line) {
        $result .= $line . "\n";
    }
    return $result;
}
function save_to_file($data)
{
    $myfile = fopen("TruongKhanhHoa_62130607.dat", "w") or die("Unable to open file!");
    foreach ($data as $i => $sinhvien) {
        $txt = implode(" ", $sinhvien);
        $txt .= "\n";
        fwrite($myfile, $txt);
    }
    fclose($myfile);
}
?>
<?php
if (isset($_POST['masv']))
    $masv = $_POST['masv'];
else $masv = "";
if (isset($_POST['hoten']))
    $hoten = $_POST['hoten'];
else $hoten = "";
if (isset($_POST['ngaysinh']))
    $ngaysinh = $_POST['ngaysinh'];
else $ngaysinh = "";

$sinh_vien_list = array(
    array("62.CNTT-1", "6212341", "Nguyễn Minh Anh", "Nữ", "2002-08-09"),
    array("62.CNTT-1", "6210123", "Trần Anh Tú", "Nam", "2002-05-21"),
    array("62.CNTT-2", "6211012", "Nguyễn Ngọc Thanh", "Nam", "2002-02-30"),
    array("62.CNTT-3", "6210123", "Lê Phương Thảo", "Nữ", "2001-10-15"),
);
if (isset($_POST['them']) || isset($_POST['luu'])) {
    if (empty($hoten) || empty($hoten) || empty($ngaysinh)) {
        echo "<font color='red'>Vui lòng nhập đầy đủ thông tin! </font>";
    } else {
        $newsv = array($_POST['malop'], $masv, $hoten, $_POST['radGT'], $ngaysinh);
        array_push($sinh_vien_list, $newsv);
        if (isset($_POST['luu'])) {
            save_to_file($sinh_vien_list);
        }
    }
}
?>
<form action="" method="post">
    <fieldset>
        <legend>Thông tin sinh viên</legend>
        <table border='0'>
            <tr>
                <td>Mã lớp:</td>
                <td>
                    <select name="malop">
                        <option value="62.CNTT-1" <?php if (isset($_POST['malop']) && $_POST['malop'] == '62.CNTT-1') echo 'selected'; ?>>
                            62.CNTT-1
                        </option>
                        <option value="62.CNTT-2" <?php if (isset($_POST['malop']) && $_POST['malop'] == '62.CNTT-2') echo 'selected'; ?>>
                            62.CNTT-2
                        </option>
                        <option value="62.CNTT-3" <?php if (isset($_POST['malop']) && $_POST['malop'] == '62.CNTT-3') echo 'selected'; ?>>
                            62.CNTT-3
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Giới tính:</td>
                <td style="display: flex;">
                    <input type="radio" name="radGT" value="Nam" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'Nam') echo 'checked="checked"'; ?> checked /> Nam<br>
                    <input type="radio" name="radGT" value="Nữ" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'Nữ') echo 'checked="checked"'; ?> /> Nữ
                </td>
            </tr>
            <tr>
                <td>Mã sinh viên:</td>
                <td><input type="text" name="masv" value="<?php if (isset($_POST['masv'])) echo $_POST['masv']; ?>" />
                </td>
            </tr>
            <tr>
                <td>Họ tên:</td>
                <td><input type="text" name="hoten" value="<?php if (isset($_POST['hoten'])) echo $_POST['hoten']; ?>" /></td>
            </tr>
            <tr>
                <td>Ngày sinh:</td>
                <td><input type="date" name="ngaysinh" value="<?php if (isset($_POST['ngaysinh'])) echo $_POST['ngaysinh']; ?>" /></td>
            </tr>
            <tr>
                <td align="center"><input type="submit" name="them" value="Thêm sinh viên" /></td>
                <td align="center"><input type="submit" name="luu" value="Lưu vào file" /></td>
            </tr>
            <tr>
                <td><a class="mt-5" href="index.php">Quay lại</a></td>
            </tr>
        </table>
    </fieldset>
</form>
<tr>
    <h3>Thông tinh sinh viên đã nhận</h3>
    <table style="width:100%;border-collapse: collapse;" border="1">
        <tr>
            <th>Mã lớp</th>
            <th>Mã SV</th>
            <th>Họ tên SV</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
        </tr>
        <?php
        foreach ($sinh_vien_list as $sinhvien) {
            echo "
                    <tr>
                        <td>$sinhvien[0]</td>
                        <td>$sinhvien[1]</td>
                        <td>$sinhvien[2]</td>
                        <td>$sinhvien[3]</td>
                        <td>$sinhvien[4]</td>
                    </tr>
                    ";
        }
        ?>
    </table>
</tr>
<?php $this->end(); ?>