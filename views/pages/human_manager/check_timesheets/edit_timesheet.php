<?php $this->layout('layout_manager') ?>
<?php $this->section('content'); ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
$MaNV = $_GET['MaNV'];

$strdate = $_GET['Nam'] . '-' . $_GET['Thang'] . '-' . $_GET['Ngay'];
$sqlnv = "select nhan_vien.MaNV, HoNV, TenNV, TenPhong, TenChucVu,TinhTrang, NghiHL, Ngay from nhan_vien, chuc_vu, phong_ban, cham_cong
     where nhan_vien.MaNV = '$MaNV'
     and cham_cong.Ngay = '$strdate'
     and nhan_vien.MaPhong = phong_ban.MaPhong
     and nhan_vien.MaChucVu = chuc_vu.MaChucVu
     and cham_cong.MaNV = nhan_vien.MaNV";

$resultnv = mysqli_query($conn, $sqlnv);
$nv = mysqli_fetch_array($resultnv);

$sqlTangCa = "SELECT * FROM tang_ca 
    where tang_ca.MaNV = '$MaNV'
    and NgayTC = '$strdate'";

$resultTC = mysqli_query($conn, $sqlTangCa);

$numrow = mysqli_num_rows($resultTC);

if($numrow == 1){
    $tc = mysqli_fetch_array($resultTC);
    $loaiTC = $tc['LoaiTC'];
}

$hoten = $nv['HoNV'] . ' ' . $nv['TenNV'];
$phong = $nv['TenPhong'];
$chucVu = $nv['TenChucVu'];
$nghiHL = $nv['NghiHL'];
$tinhTrang = $nv['TinhTrang'];

$date = str_replace("-", "", $strdate);


$i = substr($MaNV, 2);


function TaoMaTangCa($date, $i)
{
    return "TC" .  $date . $i;
}

$maTangCa = TaoMaTangCa($date, $i);



if (isset($_POST['xacnhan'])) {

    if(isset($_POST["tinhTrang"])){
        $tinhTrang = $_POST["nghiHL"];
    }
    if(isset($_POST["tangCa"])){
        $loaiTC = $_POST["tangCa"];
    }

    if (isset($_POST["nghiHL"])) {
        $nghiHL = $_POST["nghiHL"];
    } else $nghiHL = 0;
    

    if ($_POST['tinhTrang'] == '1') {
        $updateChamCong = "UPDATE `cham_cong` 
        SET `TinhTrang` = $_POST[tinhTrang], `NghiHL`= $nghiHL WHERE MaNV = '$MaNV' AND Ngay = '$strdate'";
        mysqli_query($conn,$updateChamCong);
        if ($_POST['tangCa'] == '-1') {
            if ($numrow == 1) {
                $deleteTC = "DELETE FROM `tang_ca` WHERE MaNV = '$MaNV' AND NgayTC = '$strdate'";
                mysqli_query($conn, $deleteTC);
            }
        } else {
            if ($numrow == 0) {
                $sqlinsertTC = "INSERT INTO `tang_ca`(`MaTC`, `MaNV`, `NgayTC`, `LoaiTC`)
                                    VALUES ('$maTangCa','$MaNV','$strdate',$_POST[tangCa])";
                mysqli_query($conn, $sqlinsertTC);
            } else {
                $sqlupdateTC = "UPDATE `tang_ca` SET `LoaiTC`='$_POST[tangCa]' 
                            WHERE MaNV = '$MaNV' AND NgayTC = '$strdate'";
                mysqli_query($conn, $sqlupdateTC);
            }
        }
    } else {
        $updateChamCong = "UPDATE `cham_cong` 
        SET `TinhTrang` = $_POST[tinhTrang], `NghiHL`= $nghiHL WHERE MaNV = '$MaNV' AND Ngay = '$strdate'";
        mysqli_query($conn,$updateChamCong);

        $deleteTC = "DELETE FROM `tang_ca` WHERE MaNV = '$MaNV' AND NgayTC = '$strdate'";
        mysqli_query($conn, $deleteTC);
    }
}
?>
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">CHỈNH SỬA CHẤM CÔNG NHÂN VIÊN NGÀY <?php echo $strdate?> </h5>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr>
                            <td>Mã nhân viên</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maNV" value="<?php echo $MaNV ?>" disabled /></td>
                            <td>Họ và tên</td>
                            <td><input class="form-control py-2" type="text" name="hoTen" value="<?php echo $hoten ?>" disabled /></td>
                        </tr>
                        <tr>
                            <td>Phòng</td>
                            <td><input class="form-control py-2" type="text" size="20" name="phong" value="<?php echo $phong ?>" disabled /></td>
                            <td>Chức vụ</td>
                            <td><input class="form-control py-2" type="text" name="chucVu" value="<?php echo $chucVu ?>" disabled /></td>
                        </tr>
                        <tr>
                            <td>Tình trạng</td>
                            <td>
                                <select id='tinhTrang' name='tinhTrang' class='form-select search-option'>
                                    <option value='1' <?php if (isset($_POST['tinhTrang']) && $_POST['tinhTrang'] == '1' || $tinhTrang == '1') echo 'selected' ?>>Đi làm</option>
                                    <option value='0' <?php if (isset($_POST['tinhTrang']) && $_POST['tinhTrang'] == '0' || $tinhTrang == '0') echo 'selected' ?>>Nghỉ</option>
                                </select>
                            </td>
                            <td>Nghỉ hưởng lương</td>
                            <td>
                                <input style='transform:scale(1.5)' id='nghiHL' name='nghiHL' type='checkbox' class='xx-larger' value='1' <?php if ($nghiHL == '1') echo 'checked' ?>>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tăng ca</td>
                            <td>
                                <select id='tangCa' name='tangCa' class='form-select search-option'>
                                    <option value='-1' <?php if (isset($_POST['tangCa']) && $_POST['tangCa'] == '-1' || $numrow == 0) echo 'selected' ?>>Không Tăng Ca</option>
                                    <option value='0' <?php if (isset($_POST['tangCa']) && $_POST['tangCa'] == '0' || $loaiTC == '0') echo 'selected' ?>>Ngày Thường</option>
                                    <option value='1' <?php if (isset($_POST['tangCa']) && $_POST['tangCa'] == '1' || $loaiTC == '1') echo 'selected' ?>>Nghỉ Hằng Tuần</option>
                                    <option value='2' <?php if (isset($_POST['tangCa']) && $_POST['tangCa'] == '2' || $loaiTC == '2') echo 'selected' ?>>Nghỉ Lễ</option>
                                </select>
                            </td>
                            <td></td>
                            <script type='text/javascript'>
                                $(document).ready(function() {
                                    $('#nghiHL').prop('disabled', 'disabled');
                                    $('#tinhTrang').click(function() {
                                        if ($('#tinhTrang').val() == '1') {
                                            $('#nghiHL').prop('checked', false);
                                            $('#nghiHL').prop('disabled', 'disabled');
                                            $('#tangCa').removeAttr('disabled');
                                        } else {
                                            $('#nghiHL').removeAttr('disabled');
                                            $('#tangCa').prop('disabled', 'disabled');
                                            $('#tangCa').val('-1');
                                        }
                                    });
                                });
                            </script>
                        </tr>
                    </table>
                    <input style="margin-top:20px;" type="submit" value="Xác nhận" name="xacnhan" class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" />
                </form>
            </div>
        </div>
        <div class="option-buttons d-flex justify-content-between">
            <a href="index.php?page=human-manager-check-timesheets"><input class="btn btn-info" type="submit" value="Quay lại" /></a>
        </div>
    </div>
</div>
<?php $this->end(); ?>