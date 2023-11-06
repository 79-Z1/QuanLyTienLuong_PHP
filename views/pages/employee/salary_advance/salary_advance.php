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
function tao_ma_ul($maNV)
{
    $ngay = date("d");
    $thang = date("m");
    $nam = date("Y");
    $date = $nam . $thang . $ngay;
    $ma = substr($maNV, 2, 3);
    return "UL" . $date . $ma;
}
?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
date_default_timezone_set('Asia/Ho_Chi_Minh');
// check NV đã ứng tiền trong tháng này chưa
$thang = date('m');
$sql = "SELECT NgayUng FROM phieu_ung_luong WHERE MaNV = '$MaNV' and month(NgayUng) = $thang";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if (mysqli_num_rows($result) <> 0) {
    $ktraNgayUng = -1;
} else {
    $sql = "SELECT *  FROM nhan_vien,chuc_vu 
            WHERE MaNV = '$MaNV'
            AND nhan_vien.MaChucVu = chuc_vu.MaChucVu";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $tienUngToiDa = floor(($row['HeSoLuong'] * 4_160_000 / 2) / 100_000) * 100_000;
    $today = date("Y-m-d");
    $ktraNgayUng = 1;
}
?>
<?php
if (isset($_POST['submit'])) {
    $maul = tao_ma_ul($MaNV);
    $sotienung =  trim($_POST['sotien']);
    $lydo = trim($_POST['lydo']);
    $sqlInsert = "INSERT INTO `phieu_ung_luong`(`MaPhieu`, `MaNV`, `NgayUng`, `LyDo`, `SoTien`) 
    VALUES ('$maul','$MaNV','$today','$lydo','$sotienung')";
    $result = mysqli_query($conn, $sqlInsert);
    echo "<script type='text/javascript'>
            toastr.success('Gửi thành công');
            window.location.href = 'http://localhost/QuanLyTienLuong_PHP/views/pages/employee';
        </script>";
}
?>
<div class="container d-flex justify-content-center h-100">
    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 edit_information">
        <?php if ($ktraNgayUng == 0) { ?>
            <div class=" d-flex w-100 justify-content-center align-items-center">
                <div id="tb" class="d-flex w-75 justify-content-center align-items-center">
                    <i class="bi bi-exclamation-triangle"></i>
                    <b>Bạn chỉ được phép ứng lương kể từ ngày 15 trở đi</b>
                </div>
            </div>
        <?php } elseif ($ktraNgayUng == -1) { ?>
            <div class=" d-flex w-100 justify-content-center align-items-center">
                <div id="tb" class="d-flex w-75 justify-content-center align-items-center">
                    <i class="bi bi-exclamation-triangle"></i>
                    <b>Bạn đã ứng lương tháng này rồi</b>
                </div>
            </div>
        <?php } else { ?>
            <form action="" method="post" id="form-ul">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="profile_details_text">Ngày ứng:</label>
                            <input type="date" name="ngayung" class="form-control" value="<?= $today ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Số tiền (không vượt quá <?= money_format($tienUngToiDa) ?> đ):</label>
                            <input type="number" id="sotien" name="sotien" class="form-control" min="0" max="<?= $tienUngToiDa ?>" value="">
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Lý do (tối đa 300 kí tự):</label>
                            <textarea class="form-control" id="lydo" name="lydo" rows="3" maxlength="300"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <input type="submit" name="submit" onclick="return submitUL()" class="btn btn-success" value="Gửi">
                        </div>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
</div>