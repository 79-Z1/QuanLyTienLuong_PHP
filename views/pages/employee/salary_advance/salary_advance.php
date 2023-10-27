<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

    textarea {
        resize: none;
    }
</style>
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
?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
date_default_timezone_set('Asia/Ho_Chi_Minh');
function tao_ma_ul($maNV)
{
    $ngay = date("d");
    $thang = date("m");
    $nam = date("Y");
    $date = $nam . $thang . $ngay;
    $ma = substr($maNV, 2, 3);
    return "UL" . $date . $ma;
}
$sql = "SELECT *  FROM nhan_vien,chuc_vu 
        WHERE MaNV = '$MaNV'
        AND nhan_vien.MaChucVu = chuc_vu.MaChucVu";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$tienUngToiDa = (float)$row['HeSoLuong'] * 4_160_000 / 2;
$today = date("Y-m-d");
$ktraNgayUng = date('d') >= 15 ? true : false;
?>
<?php
if (isset($_POST['submit'])) {
    if (checkValid('sotien') && checkValid('lydo')) {
        $sotienung =  $_POST['sotien'];
        $lydo = $_POST['lydo'];
    } else echo "<script>toastr.error('Vui lòng điền đầy đủ thông tin')</script>";
}
?>
<div class="container d-flex justify-content-center h-100">
    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 edit_information">
        <?php if (!$ktraNgayUng) : ?>
            <div class="d-flex justify-content-center align-items-center h-100">
                <p style="font-size: 30px;">Bạn chỉ được phép ứng lương kể từ ngày 15 trở đi</p>
            </div>
        <?php else : ?>
            <form action="" method="post">
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
                            <input type="number" name="sotien" class="form-control" value="<?= $sotienung ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Lý do (tối đa 300 kí tự):</label>
                            <textarea class="form-control" name="lydo" value="<?= $lydo ?? '' ?>" rows="3" maxlength="300"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-success" value="Submit">
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>

    </div>
</div>