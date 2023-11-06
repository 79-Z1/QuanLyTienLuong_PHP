<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>

<?php
//Ket noi CSDL
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");



$sqlChucVu = 'select * from chuc_vu ';
$resultChucVu = mysqli_query($conn, $sqlChucVu);

if (isset($_POST['maCV']))
    $maCV = trim($_POST['maCV']);
else $maCV = "";

if (isset($_POST['tenCV']))
    $tenCV = trim($_POST['tenCV']);
else $tenCV = "";

if (isset($_POST['HSL']))
    $HSL = trim($_POST['HSL']);
else $HSL = "";


if (isset($_POST['them'])) {

    $err = array();

    if (empty($maCV)) {
        $err[] = "Vui lòng nhập mã chức vụ";
    }
    if (empty($tenCV)) {
        $err[] = "Vui lòng nhập tên chức vụ";
    }
    if (!empty($HSL) && !is_numeric($HSL)) {
        $err[] = "Hệ số lương phải là một số";
    }

    if (empty($err)) {
        $sqlInsert = "INSERT INTO `chuc_vu`(`MaChucVu`, `TenChucVu`, `HeSoLuong`) 
                            VALUES ('$maCV','$tenCV',$HSL)";
        $resultInsert = mysqli_query($conn, $sqlInsert);

        if ($resultInsert) {
            echo "<script type='text/javascript'>toastr.success('Thêm thành công'); toastr.options.timeOut = 3000;</script>";
            $maCV = "";
            $tenCV = "";
            $HSL = "";
        } else {
            echo "<script type='text/javascript'>toastr.error('Thêm không thành công'); toastr.options.timeOut = 3000;</script>";
        }
    } else {
        foreach ($err as $error) {
            echo "<script type='text/javascript'>toastr.error(' $error'); toastr.options.timeOut = 3000;</script>";
        }
    }
}
?>
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">THÊM CHỨC VỤ</h5>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr class="tr">
                            <td>Mã chức vụ</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maCV" value="<?php echo $maCV; ?> " /></td>
                            <td>Hệ số lương</td>
                            <td><input class="form-control py-2" type="text" name="HSL" value="<?php echo $HSL; ?> " /></td>
                        </tr>
                        <tr class="tr">
                            <td>Tên chức vụ </td>
                            <td><input class="form-control py-2" type="text" size="20" name="tenCV" value="<?php echo $tenCV; ?> " /></td>
                            <td id="no_color" colspan="2">
                                <input type="submit" value="Thêm" name="them" class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" />
                                <a class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" href="index.php?page=admin-position"> Quay Lại</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->end(); ?>