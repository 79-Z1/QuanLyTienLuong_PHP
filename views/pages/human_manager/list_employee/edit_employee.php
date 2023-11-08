<?php $this->layout('layout_manager') ?>
<?php $this->section('content'); ?>


<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
$maNVien = $_GET['MaNV'];
$getNV = "select * from nhan_vien
    where MaNV='$maNVien'";
$resultNV = mysqli_query($conn, $getNV);
$nv = mysqli_fetch_array($resultNV);

$maNV = $nv['MaNV'];

$newhinh = $nv['Hinh'];


if (isset($_POST['hoNV']))
        $hoNV = trim($_POST['hoNV']);
    else $hoNV = $nv['HoNV'];

    if (isset($_POST['tenNV']))
        $tenNV = trim($_POST['tenNV']);
    else $tenNV = $nv['TenNV'];

    if (isset($_POST['soCon']))
        $soCon = trim($_POST['soCon']);
    else $soCon = $nv['SoCon'];

    if (isset($_POST['ngaySinh']))
        $ngaySinh = trim($_POST['ngaySinh']);
    else $ngaySinh = $nv['NgaySinh'];

    if (isset($_POST['cccd']))
        $cccd = trim($_POST['cccd']);
    else $cccd = $nv['CCCD'];

    if (isset($_POST['stk']))
        $stk = trim($_POST['stk']);
    else $stk = $nv['STK'];

    if (isset($_POST['soDienThoai']))
        $sdt = trim($_POST['soDienThoai']);
    else $sdt = $nv['SDT'];

    if (isset($_POST['diaChi']))
        $diaChi = trim($_POST['diaChi']);
    else $diaChi = $nv['DiaChi'];


    if (isset($_POST['email']))
        $Email = trim($_POST['email']);
    else $Email = $nv['Email'];

$err = array();

$allowed = array('image/jpeg', 'image/png');

// connect mysql

$getPhongBan = "select MaPhong, TenPhong from phong_ban";

$resultPhongBan = mysqli_query($conn, $getPhongBan);

$getChucVu = "select MaChucVu, TenChucVu from chuc_vu";

$resultChucVu = mysqli_query($conn, $getChucVu);

$tuoiNamToiThieu = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS027'"))['GiaTri'];
$tuoiNamToiDa = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS029'"))['GiaTri'];

$tuoiNuToiThieu = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS028'"))['GiaTri'];
$tuoiNuToiDa = mysqli_fetch_array(mysqli_query($conn, "SELECT GiaTri FROM `tham_so` WHERE MaTS = 'TS030'"))['GiaTri'];



if (isset($_POST['chinhsua'])) {    

    $gt = $_POST['radGT'];

    $tuoi = date('Y') - date('Y', strtotime($ngaySinh));
    if ($gt == 1) {
        if ($tuoi < $tuoiNamToiThieu || $tuoi > $tuoiNamToiDa)
            $err[] = "Vui lòng chọn lại ngày sinh <br> Tuổi nhân viên nam phải <br> từ $tuoiNamToiThieu đến $tuoiNamToiDa tuổi";
    } else {
        if ($tuoi < $tuoiNuToiThieu || $tuoi > $tuoiNuToiDa)
            $err[] = "Vui lòng chọn lại ngày sinh <br> Tuổi nhân viên nữ phải <br> từ $tuoiNuToiThieu đến $tuoiNuToiDa tuổi";
    }
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $err[] = "Vui lòng nhập đúng định dạng email";
    }

    if (!is_numeric($stk)) {
        $err[] = "Vui lòng nhập số tài khoản đúng định dạng số";
    }
    if ($diaChi == "") {
        $err[] = "Vui lòng nhập địa chỉ";
    }
    if (!is_numeric($sdt)) {
        $err[] = "Vui lòng nhập số điện thoại đúng định dạng số";
    }
    if (!is_numeric($cccd)) {
        $err[] = "Vui lòng nhập căn cước công dân đúng định dạng số";
    }
    if ($ngaySinh == "") {
        $err[] = "Vui lòng chọn ngày sinh";
    }
    if ($tenNV == "") {
        $err[] = "Vui lòng nhập tên nhân viên";
    }
    if ($hoNV == "") {
        $err[] = "Vui lòng nhập họ nhân viên";
    }

    if ($_FILES['imgnv']['name'] != NULL) {
        if (!in_array($_FILES['imgnv']['type'], $allowed)) {
            $err[] = "Vui lòng chọn đúng định dạng ảnh";
        }
    }

    if (empty($err)) {
        if($_FILES['imgnv']['name'] != NULL){
            $hinh = explode(".", $_FILES['imgnv']['name']);
            $tempname = $_FILES["imgnv"]["tmp_name"];
            $hinh[0] = $maNV;
            $newhinh = implode(".", $hinh);
            $folder = $_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/images/imgnv/" . $newhinh;

            move_uploaded_file($tempname, $folder);
            $update = "UPDATE `nhan_vien` 
                SET `HoNV`='$hoNV',`TenNV`='$tenNV',`GioiTinh`=$gt,
                `NgaySinh`='$ngaySinh',`DiaChi`='$diaChi',`MaPhong`='$_POST[phong]',`STK`='$stk',
                `CCCD`='$cccd',`MaChucVu`='$_POST[chucVu]',`SoCon`='$soCon',
                `Hinh`='$newhinh',`SDT`='$sdt',`Email`='$Email'
                WHERE `MaNV` = '$maNVien'";
        }else{
            $update = "UPDATE `nhan_vien` 
                SET `HoNV`='$hoNV',`TenNV`='$tenNV',`GioiTinh`=$gt,
                `NgaySinh`='$ngaySinh',`DiaChi`='$diaChi',`MaPhong`='$_POST[phong]',`STK`='$stk',
                `CCCD`='$cccd',`MaChucVu`='$_POST[chucVu]',`SoCon`='$soCon',`SDT`='$sdt',`Email`='$Email'
                WHERE `MaNV` = '$maNVien'";
        }
        mysqli_query($conn, $update);

        $nv['MaPhong'] = $_POST['phong'];

        $nv['MaChucVu'] = $_POST['chucVu'];

        echo "<script type='text/javascript'>toastr.success('Chỉnh sửa nhân viên thành công'); toastr.options.timeOut = 3000;</script>";
    } else {
        foreach ($err as $lois) {
            echo "<script type='text/javascript'>toastr.error('$lois'); toastr.options.timeOut = 3000;</script>";
        }
    }
}
?>
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h2 class="mb-0">CHỈNH SỬA NHÂN VIÊN</h2>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr>
                            <td class="label-info">Mã nhân viên</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maNV" value="<?php echo $maNV; ?> " disabled="disabled" /></td>
                            <td class="label-info">Số con</td>
                            <td class="info <?php if ($soCon == "") echo 'required'; ?>"><input class="form-control py-2" type="text" name="soCon" value="<?php echo $soCon; ?> " /></td>
                        </tr>
                        <tr>
                            <td class="label-info">Họ </td>
                            <td class="info <?php if ($hoNV == "") echo 'required'; ?>"><input class="form-control py-2" type="text" size="20" name="hoNV" value="<?php echo $hoNV; ?> " /></td>
                            <td class="label-info">Tên</td>
                            <td class="info <?php if ($tenNV == "") echo 'required'; ?>"><input class="form-control py-2" type="text" name="tenNV" value="<?php echo $tenNV; ?> " /></td>
                        </tr>
                        <tr>
                            <td class="label-info">Phòng</td>
                            <td class="info">
                                <select class="form-select py-2" name="phong">
                                    <?php
                                    if (mysqli_num_rows($resultPhongBan) <> 0) {
                                        while ($rows = mysqli_fetch_array($resultPhongBan)) {
                                            echo "<option value='$rows[MaPhong]'";
                                            if (isset($_POST['phong']) && $_POST['phong'] == $rows['MaPhong'] || $rows['MaPhong'] == $nv['MaPhong']) echo 'selected';
                                            echo ">$rows[TenPhong]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td >
                            <td class="label-info">Chức Vụ</td>
                            <td class="info">
                                <select class="form-select py-2" name="chucVu">
                                    <?php
                                    if (mysqli_num_rows($resultChucVu) <> 0) {
                                        while ($rows = mysqli_fetch_array($resultChucVu)) {
                                            echo "<option value='$rows[MaChucVu]'";
                                            if (isset($_POST['chucVu']) && $_POST['chucVu'] == $rows['MaChucVu'] || $rows['MaChucVu'] == $nv['MaChucVu']) echo 'selected';
                                            echo ">$rows[TenChucVu]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-info">Ngày sinh</td>
                            <td class="info <?php if ($ngaySinh == "") echo 'required'; ?>"><input class="form-date-control py-2" type="date" name="ngaySinh" value="<?php echo $ngaySinh; ?>" /></td>
                            <td class="label-info">CCCD</td>
                            <td class="info <?php if ($cccd == "") echo 'required'; ?>"><input class="form-control py-2" type="text" name="cccd" value="<?php echo $cccd; ?> " /></td>
                        </tr>
                        <tr>
                            <td class="label-info">Giới tính</td>
                            <td class="info">
                                <input type="radio" name="radGT" value="1" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == '1' || $nv['GioiTinh'] == '1') echo 'checked="checked"'; ?> checked />
                                Nam
                                <input type="radio" name="radGT" value="0" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == '0' || $nv['GioiTinh'] == '0') echo 'checked="checked"'; ?> />
                                Nữ
                            </td>
                            <td class="label-info">Số tài khoản</td>
                            <td class="info <?php if ($stk == "") echo 'required'; ?>"><input class="form-control py-2" type="text" name="stk" value="<?php echo $stk; ?> " /></td>
                        </tr>
                        <tr>
                            <td class="label-info">Số điện thoại</td>
                            <td class="info <?php if ($sdt == "") echo 'required'; ?>">
                                <input class="form-control py-2" type="text" name="soDienThoai" value="<?php echo $sdt; ?> " />
                            </td>
                            <td class="label-info">Địa chỉ</td>
                            <td class="info <?php if ($diaChi == "") echo 'required'; ?>">
                                <input class="form-control py-2" type="text" name="diaChi" value="<?php echo $diaChi; ?> " />
                            </td>
                        </tr>
                        <tr>
                            <td class="label-info">
                                Ảnh nhân viên <br>
                            </td>
                            <td>
                                <img style="margin-bottom: 20px" width="20%" src='<?php echo "" . "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/images/imgnv/$newhinh" . "" ?>' alt='Avatar'>
                                <br>
                                <input class="form-control-img" type="file" id="formFile" name="imgnv">
                            </td>
                            <td class="label-info">Email</td>
                            <td class="info <?php if ($Email == "") echo 'required'; ?>">
                                <input class="form-control py-2" type="text" name="email" value="<?php echo $Email; ?> " />
                            </td>
                        </tr>
                        <tr>
                            <td id="no_color" colspan="4" align="center">
                                <input style="margin-top: 20px" type="submit" value="Lưu" name="chinhsua" class="btn btn-outline-purple mb-5 w-25" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="option-buttons d-flex justify-content-between">
            <a href="index.php"><input class="btn btn-outline-purple" type="submit" value="Quay lại" /></a>
        </div>
    </div>
</div>
<?php $this->end(); ?>