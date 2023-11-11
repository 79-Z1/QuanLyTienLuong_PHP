<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sữa mới</title>
    <style>
        table {
            background: #ffd94d;
            border: 0 solid yellow;
        }

        thead {
            background: #fff14d;
        }

        td {
            color: blue;
        }

        h3 {
            font-family: verdana;
            text-align: center;
            color: #ff8100;
            font-size: 30px;
        }
    </style>
</head>
<?php
function money_format($tien)
{
    return number_format($tien, 0, ',', '.');
}

function checkValid($name): bool
{
    if (isset($_POST["$name"]) && empty(trim($_POST["$name"]))) {
        return false;
    }
    return true;
}
function tao_ma_sua($soluong) {
    if($soluong < 10) {
        return "SUA00".$soluong;
    } else if ($soluong < 100) {
        return "SUA0".$soluong;
    }  else if ($soluong < 1000) {
        return "SUA".$soluong;
    }
}
?>
<?php
require("connect.php");
$sqlGetTTHangSua = 'select * from hang_sua';
$tthangsua = mysqli_query($conn, $sqlGetTTHangSua);
$sqlGetTTLoaiSua = 'select * from loai_sua';
$ttloaisua = mysqli_query($conn, $sqlGetTTLoaiSua);
$sqlDemSua = "SELECT * FROM `sua`";
$ttsua = mysqli_query($conn, $sqlDemSua);
$soluongsua = mysqli_num_rows($ttsua);
$masua = tao_ma_sua($soluongsua + 1);
if(isset($_POST['them'])) {
    if(checkValid('tensua') && checkValid('trongluong') && checkValid('dongia') && checkValid('trongluong') && checkValid('tpdinhduong') && checkValid('loiich')) {
        if(isset($_FILES['hinhanh']['name'])!=NULL) {
            $hinhsua = $_FILES['hinhanh']['name'];
            $tempname = $_FILES["hinhanh"]["tmp_name"];
            $folder = "C:\\xampp\\htdocs\\bai_tap\\mysql\\QLBanSua\\Sua\\img\\".$hinhsua;
            $sqlInsert = "INSERT INTO `sua`(`Ma_sua`, `Ten_sua`, `Ma_hang_sua`, `Ma_loai_sua`, `Trong_luong`, `Don_gia`, `TP_Dinh_Duong`, `Loi_ich`, `Hinh`) 
            VALUES ('$masua','$_POST[tensua]','$_POST[hangsua]','$_POST[loaisua]','$_POST[trongluong]','$_POST[dongia]','$_POST[tpdinhduong]','$_POST[loiich]','$hinhsua')";
            mysqli_query($conn, $sqlInsert);
            move_uploaded_file($tempname,$folder);
            echo "<h2>Thêm thành công</h2>";
        }else echo "<h2>Vui lòng chọn file</h2>";
    } else echo "<h2>Vui lòng nhập đầy đủ thông tin</h2>";
}
?>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <table align='center' border='1' cellpadding='2' cellspacing='2' style='border-collapse:collapse'>
            <thead>
                <th align="center" colspan="2">THÊM SỮA MỚI</th>
            </thead>
            <tr>
                <td>Mã sữa</td>
                <td><input type="text" name="masua" value="<?= $masua ?? ''?>" disabled/></td>
            </tr>
            <tr>
                <td>Tên sữa</td>
                <td><input type="text" name="tensua" value="<?php if (isset($_POST['tensua'])) echo $_POST['tensua']; ?>" /></td>
            </tr>
            <tr>
                <td>Hãng sữa</td>
                <td>
                    <select name="hangsua">
                        <?php while ($rows = mysqli_fetch_array($tthangsua)) { ?>
                            <option value="<?= $rows['Ma_hang_sua'] ?>" <?php if (isset($_POST['hangsua']) && $_POST['hangsua'] == $rows['Ma_hang_sua']) echo 'selected'; ?>>
                                <?= $rows['Ten_hang_sua'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Loại sữa</td>
                <td>
                    <select name="loaisua">
                        <?php while ($rows = mysqli_fetch_array($ttloaisua)) { ?>
                            <option value="<?= $rows['Ma_loai_sua'] ?>" <?php if (isset($_POST['loaisua']) && $_POST['loaisua'] == $rows['Ma_loai_sua']) echo 'selected'; ?>>
                                <?= $rows['Ten_loai'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Trọng lượng</td>
                <td><input type="number" name="trongluong" value="<?php if (isset($_POST['trongluong'])) echo $_POST['trongluong']; ?>" />(gr hoặc ml)</td>
            </tr>
            <tr>
                <td>Đơn giá</td>
                <td><input type="number" name="dongia" value="<?php if (isset($_POST['dongia'])) echo $_POST['dongia']; ?>" />(VNĐ)</td>
            </tr>
            <tr>
                <td>Thành phần dinh dưỡng</td>
                <td>
                    <textarea name="tpdinhduong" rows="3" cols="40"><?php if (isset($_POST['tpdinhduong'])) echo $_POST['tpdinhduong']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>Lợi ích</td>
                <td>
                    <textarea name="loiich" rows="3" cols="40"><?php if (isset($_POST['loiich'])) echo $_POST['loiich']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>Hình ảnh</td>
                <td><input type="file" name="hinhanh" value="<?php if (isset($_POST['hinhanh'])) echo $_POST['hinhanh']; ?>" accept="image/png, image/gif, image/jpeg" /></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="them" value="Thêm"></td>
            </tr>
        </table>
    </form>
</body>

</html>