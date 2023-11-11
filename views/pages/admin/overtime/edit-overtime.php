<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$sqlNhanVien = 'select * from nhan_vien ';
$resultNhanVien = mysqli_query($conn, $sqlNhanVien);

$conn = mysqli_connect('localhost', 'root', '', 'quan_ly_tien_luong') or die('Could not connect to MySQL: ' . mysqli_connect_error());

$maTC = $_GET["maTC"];
$getTangCa = "select * from tang_ca where MaTC='$maTC'";
$resultTangCa = mysqli_query($conn, $getTangCa);
$row = mysqli_fetch_array($resultTangCa, MYSQLI_ASSOC);
$maNV = $row["MaNV"];
$ngayTC = $row["NgayTC"];
$loaiTC = $row["LoaiTC"];

if (isset($_POST["MaNV"])) {
    $maNV = $_POST['MaNV'];
}
if (isset($_POST["loaiTC"])) {
    $loaiTC = $_POST['loaiTC'];
}
if (!isset($_POST["ngayTC"])) {
    $_POST['ngayTC'] = $ngayTC;
}

if (isset($_POST['edit'])) {

    $err = array();

    if (empty($maTC)) {
        $err[] = "Vui lòng nhập mã tăng ca";
    }
    if (empty($ngayTC)) {
        $err[] = "Vui lòng nhập ngày tháng";
    }
    if ($loaiTC > 2) {
        $err[] = "Loại tăng ca không quá 2";
    }

    if (empty($err)) {
        $sqlupdate = "UPDATE `tang_ca` SET `MaTC`='$maTC',`MaNV`='$maNV',`NgayTC`='$_POST[ngayTC]',`LoaiTC`='$loaiTC' WHERE MaTC ='$maTC'";

        $resultupdate = mysqli_query($conn, $sqlupdate);

        echo "<script type='text/javascript'>toastr.success('Sửa thành công'); toastr.options.timeOut = 3000;</script>";
    } else {
        foreach ($err as $error) {
            echo "<script type='text/javascript'>toastr.error('$error'); toastr.options.timeOut = 3000;</script>";
        }
    }
}
?>

<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">SỬA TĂNG CA</h5>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr class="tr">
                            <td>Mã tăng ca</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maTC" value="<?php echo $row["MaTC"]; ?> " disabled /></td>
                            <td>Mã nhân viên</td>
                            <td><select name="MaNV" class="form-select search-option">
                                    <?php
                                    if (mysqli_num_rows($resultNhanVien) <> 0) {
                                        while ($rows = mysqli_fetch_array($resultNhanVien)) {
                                            echo "<option value='$rows[MaNV]'";
                                            if (isset($_POST['MaNV']) && $_POST['MaNV'] == $rows['MaNV'] || $rows['MaNV'] == $row['MaNV']) echo "selected";
                                            echo ">$rows[MaNV]</option>";
                                        }
                                    }
                                    ?>
                                </select></td>
                        </tr>
                        <tr class="tr">
                            <td>Ngày tăng ca</td>
                            <td><input class="form-control py-2" type="date" name="ngayTC" value="<?php echo $_POST['ngayTC']; ?>" /></td>
                            <td>Loại tăng ca</td>
                            <td>
                                <select name="loaiTC" class="form-select search-option">
                                    <option value="0" <?php if ($loaiTC == '0') echo " selected"; ?>>Ngày thường</option>
                                    <option value="1" <?php if ($loaiTC == '1') echo " selected"; ?>>Nghỉ hàng tuần</option>
                                    <option value="2" <?php if ($loaiTC == '2') echo " selected"; ?>>Nghỉ lễ</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td id="no_color" align="center" colspan="4">
                                <input type="submit" value="Lưu" name="edit" class="btn btn-outline-success themnhanvien-btn mb-5 w-25" />
                                <a class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" href="index.php?page=admin-overtime"> Quay Lại</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->end(); ?>