<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

    $maCV = $_GET["maCV"];
    $getChucVu = "select * from chuc_vu where MaChucVu='$maCV'";   
    $resultChucVu = mysqli_query($conn, $getChucVu );
    $row = mysqli_fetch_array($resultChucVu, MYSQLI_ASSOC);
    $tenCV = $row["TenChucVu"];
    $HSL = $row["HeSoLuong"];
    
    $err = array();


?>
<style>
    .form-control.form-select{
        padding-top: 0.3rem !important;
        padding-bottom: 0.3rem !important;
        
    }
    .form-select{
        width: 100%;
        padding-left: 20px;
    } 
</style>
<?php

    if (isset($_POST['delete'])) {
        $sqldelete = "delete from chuc_vu 
        where MaChucVu = '$maCV'";
        mysqli_query($conn, $sqldelete);
        echo $sqldelete;
    }
    
?>
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">XÓA CHỨC VỤ</h5>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr class="tr">
                            <td>Mã chức vụ</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maCV"
                                    value="<?php echo $row["MaChucVu"]; ?> " disabled="disabled" /></td>
                            <td>Hệ số lương</td>
                            <td><input class="form-control py-2" type="text" name="HSL"
                                    value="<?php echo $HSL; ?> " disabled="disabled"/></td>
                        </tr>
                        <tr class="tr">
                            <td>Tên chức vụ </td>
                            <td><input class="form-control py-2" type="text" size="20" name="tenCV"
                                    value="<?php echo $tenCV; ?> " disabled="disabled" /></td>
                            <td id="no_color" colspan="2">
                                <input type="submit" value="delete" name="delete"
                                    class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" />
                                <a class="btn btn-outline-purple themnhanvien-btn mb-5 w-25"
                                    href="index.php?page=admin-position"> Quay Lại</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->end(); ?>