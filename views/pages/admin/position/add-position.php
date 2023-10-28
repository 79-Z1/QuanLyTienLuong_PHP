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
            echo "<script>";
            echo "alert('Thêm chức vụ thành công')";
            echo "</script>";
            // làm mới giá trị
            $maCV = "";
            $tenCV = "";
            $HSL = "";
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    } else {

        echo "<script>";
        foreach ($err as $error) {
            echo "alert('$error');";
        }
        echo "</script>";
    }
}
?>
<style>
    .form-control.form-select{
        padding-top: 0.3rem !important;
        padding-bottom: 0.3rem !important;
        
    }
    /* .form-control-nv-left{ 
        width: 20%;
        padding-left: 20px;
    }
    .form-control-sdt-left{ 
        width: 30%;
        padding-left: 20px;
    }
    .form-control-left{ 
        width: 40%;
        padding-left: 20px;
    }
    .form-select-left{ 
        width: 70%;
        padding-left: 20px;
    }
    .form-control-tt-right{
        width: 15%;
        padding-left: 20px;
    }
    .form-select-cv-right{
        width: 35%;
        padding-left: 20px;
    }
    .form-control-dc-right{
        width: 75%;
        padding-left: 20px;
    }
    .form-control-right{
        width: 30%;
        padding-left: 20px;
    }*/.form-control{
        width: 100%;
        height: 40px;
        padding-left: 20px;
    } 
    .form-select{
        width: 75%;
        padding-left: 20px;
    } 
    .form-date-control{
        text-align: center;
        width: 23%;
    }
    .form-control-img{
        width: 50%;
        
    }
    .tr td{
        font-size: 20px!important;
        height: 20%!important;
        font-weight: bold;
    }

</style>
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">THÊM NHÂN VIÊN</h5>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table  class="table table-hover table-nowrap">
                        <tr class="tr">
                            <td>Mã chức vụ</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maCV" value="<?php echo $maCV; ?> " /></td>
                            <td>Hệ số lương</td>
                            <td class="<?php if ($soCon == "") echo 'required'; ?>"><input class="form-control py-2" type="text" name="HSL" value="<?php echo $HSL; ?> " /></td>
                        </tr>
                        <tr class="tr">
                            <td>Tên chức vụ </td>
                            <td ><input class="form-control py-2" type="text" size="20" name="tenCV" value="<?php echo $tenCV; ?> " /></td>
                            <td id="no_color" colspan="2">
                                <input type="submit" value="Thêm" name="them" class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" />
                                <a  class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" href="index.php?page=admin-position"> Quay Lại</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->end(); ?>