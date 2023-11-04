<html>
<?php $this->renderSection('header_employee'); ?>
<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
$sqlTT = "select MaNV, HoNV, TenNV, Hinh from nhan_vien
        where MaNV = '$_SESSION[MaNV]'";
$resultTT = mysqli_query($conn, $sqlTT);
if (mysqli_num_rows($resultTT) > 0) {
    $TT = mysqli_fetch_array($resultTT);
}

if (isset($_POST['oldPass'])) {
    $oldPass = trim($_POST['oldPass']);
} else $oldPass = "";

if (isset($_POST['newPass'])) {
    $newPass = trim($_POST['newPass']);
} else $newPass = "";

if (isset($_POST['reNewPass'])) {
    $reNewPass = trim($_POST['reNewPass']);
} else $reNewPass = "";

function CheckOldPassword($conn, $maNV, $oldPass)
{
    $sqlCheck = "select * from tai_khoan
        where TenTK = '$maNV' and MatKhau = '$oldPass'";
    $resultCheck = mysqli_query($conn, $sqlCheck);
    if (mysqli_num_rows($resultCheck) > 0) {
        return true;
    }
    return false;
}
$titleOldPass = "<b>Mật khẩu cũ</b>";
$titleNewPass = "<b>Mật khẩu mới</b>";
$titleReNewPass = "<b>Nhập lại mật khẩu mới</b>";

if (isset($_POST["change"])) {
    if (CheckOldPassword($conn, $TT['MaNV'], $oldPass) && $oldPass !="" && $newPass != "" && $reNewPass != "") {
        mysqli_query($conn,"UPDATE `tai_khoan` SET `MatKhau`= '$newPass' WHERE TenTK = '$TT[MaNV]'");
        echo "<script type='text/javascript'>
                toastr.success('Đổi mật khẩu thành công!');
            </script>";
    }
    if(!CheckOldPassword($conn, $TT['MaNV'], $oldPass)){
        $titleOldPass = "<b style='color:red;'>*Mật khẩu cũ không đúng</b>";
    }
    if($oldPass == ""){
        $titleOldPass = "<b style='color:red;'>*Mật khẩu cũ không được để trống</b>";
    }
    if($newPass == ""){
        $titleNewPass = "<b style='color:red;'>*Mật khẩu mới không được để trống</b>";
    }
    if($reNewPass == ""){
        $titleReNewPass = "<b style='color:red;'>*Nhập lại mật khẩu không được để trống</b>";
    }
    if($newPass != $reNewPass){
        $titleReNewPass = "<b style='color:red;'>*Nhập lại mật khẩu không đúng</b>";
    }
}
?>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div>
        <form action="" method="post">
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


                            <?= $titleOldPass ?>
                            <input class="form-control py-2" type="password" size="20" name="oldPass" value="<?= $oldPass ?>" />


                            <?= $titleNewPass ?>
                            <input class="form-control py-2" type="password" size="20" name="newPass" value="<?= $newPass ?>" />


                            <?= $titleReNewPass ?>
                            <input class="form-control py-2" type="password" size="20" name="reNewPass" value="<?= $reNewPass ?>" />

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <input id="change" class="btn btn-danger" type="submit" value="Đổi mật khẩu" name="change"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- BEGIN USER PROFILE -->
        <div class="col-md-12">
            <div class="grid profile">
                <div class="grid-header">
                    <div class="d-flex justify-content-between">
                        <img src="<?php echo "/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/assets/images/imgnv/$TT[Hinh]" ?>" alt="Ảnh nhân viên">
                        <div>
                            <h1>PHÒNG KHÁM ĐA KHOA THIỆN TRANG</h1>
                            <h2><?= $TT["HoNV"] . " " . $TT["TenNV"] ?></h2>
                        </div>
                        <div class='option-buttons'>
                            <!-- <a href="index.php"><input class="btn btn-info" type="submit" value="Quay lại" /></a> -->
                            <input class="btn" type="submit" value="Đổi mật khẩu" data-bs-toggle="modal" data-bs-target="#doimatkhau" />
                        </div>
                    </div>
                </div>
                <div class="grid-body">
                    <?php $this->renderSection('content'); ?>
                </div>
            </div>
        </div>
        <!-- END USER PROFILE -->
</body>

</html>