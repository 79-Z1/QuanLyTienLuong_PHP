<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>

<?php
//Ket noi CSDL
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

if (isset($_POST['maTS']))
    $maTS = trim($_POST['maTS']);
else $maTS = "";
if (isset($_POST['tenTS']))
    $tenTS = trim($_POST['tenTS']);
else $tenTS = "";
if (isset($_POST['DVT']))
    $DVT = trim($_POST['DVT']);
else $DVT = "";
if (isset($_POST['giaTri']))
    $giaTri = trim($_POST['giaTri']);
else $giaTri = "";
if (isset($_POST['tinhTrang']))
    $tinhTrang = trim($_POST['tinhTrang']);
else $tinhTrang = "";
if (isset($_POST['loaiTC']))
    $loaiTC = trim($_POST['loaiTC']);
else $loaiTC = "";


if (isset($_POST['add'])) {

    $err = array();

    if (empty($maTS)) {
        $err[] = "Vui lòng nhập mã tham số";
    }
    if (empty($tenTS)) {
        $err[] = "Vui lòng nhập tên tham số";
    }
    if (empty($DVT)) {
        $err[] = "Vui lòng nhập đơn vị tính";
    }
    if (empty($giaTri)) {
        $err[] = "Vui lòng nhập giá trị";
    }
    if (!is_numeric($tinhTrang)) {
        $err[] = "Vui lòng nhập tình trạng";
    } 
    if($tinhTrang > 1 ){
        $err[] = "Tình trạng chỉ có 0 và 1";
    }


    if (empty($err)) {
        $sqlInsert = "INSERT INTO `tham_so`(`MaTS`, `TenTS`, `DVT`, `GiaTri`, `TinhTrang`) VALUES ('$maTS','$tenTS','$DVT','$giaTri',$tinhTrang)";
        $resultInsert = mysqli_query($conn, $sqlInsert);

        if ($resultInsert) {
            echo "<script type='text/javascript'>toastr.success('Thêm thành công'); toastr.options.timeOut = 3000;</script>";
        } else {
            echo "<script type='text/javascript'>toastr.error('Thêm không thành công'); toastr.options.timeOut = 3000;</script>";
        }
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
                <h3 class="mb-0">THÊM THAM SỐ</h3>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr class="tr">
                            <td>Mã tham số</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maTS" value="<?php echo $maTS; ?>" /></td>
                            <td>Tên tham số</td>
                            <td><input class="form-control py-2" type="text" size="20" name="tenTS" value="<?php echo $tenTS; ?>" /></td>
                        </tr>
                        <tr class="tr">
                            <td>Đơn vị tính </td>
                            <td>
                                <input class="form-control py-2" type="text" size="20" name="DVT" value="<?php echo $DVT; ?>" />
                            </td>
                            <td>Giá trị</td>
                            <td>
                                <input class="form-control py-2" type="text" size="20" name="giaTri" value="<?php echo $giaTri; ?>" />
                            </td>
                        </tr>
                        <tr class="tr">
                            <td>Tình trạng</td>
                            <td>
                                <input class="form-control py-2" type="text" size="20" name="tinhTrang" value="<?php echo $tinhTrang; ?>" />
                            </td>
                        </tr>
                        <tr class="tr">
                            <td id="no_color" align="center" colspan="4">
                                <input type="submit" value="Thêm" name="add" class="btn btn-outline-purple me-3 themnhanvien-btn mb-5 w-25" />
                                <a class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" href="index.php?page=admin-parameter">Quay Lại</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->end(); ?>