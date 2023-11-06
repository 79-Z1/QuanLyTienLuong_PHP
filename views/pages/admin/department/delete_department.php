<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

    $maP = $_GET["MaPhong"];
    $getPhongBan = "select * from phong_ban
    where MaPhong='$maP'";   
    $resultPhongBan = mysqli_query($conn, $getPhongBan );
    $row = mysqli_fetch_array($resultPhongBan, MYSQLI_ASSOC);
    $TenPhong = $row["TenPhong"];
    

    $err = array();
?>
<?php

if (isset($_POST['delete'])) {
    $sqldelete = "delete from phong_ban where MaPhong = '$maP'";
    $deleteResult = mysqli_query($conn, $sqldelete);
    if ($deleteResult) {
        echo "<script type='text/javascript'>
        $('#delete').prop('disabled','disabled');
        toastr.success('Xoá phòng ban thành công');
        setTimeout(function() {
            window.location.href = '/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/admin?page=admin-department" . "';
        }, 1500);
        </script>";
    } 
}

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
    /* tbody{
        
        font-weight: bold;
        height: 597px;
    } */
</style>
<?php

    if (isset($_POST['delete'])) {
        $sqldelete = "delete from phong_ban 
        where MaPhong = '$_GET[MaPhong]'";
        mysqli_query($conn, $sqldelete);
    }
    
?>
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">XÓA PHÒNG BAN</h5>
            </div>
            <div class="table-responsive">
            <form align='center' action="" method="post" enctype="multipart/form-data">
                <table class="table table-hover table-nowrap">
                    <tr>
                        <td>Mã Phòng</td>
                    <td>
                    <td>
                        <input class="form-control py-2" type="text" size="20" name="maP" value="<?php echo $maP; ?> "disabled="disabled" /></td>
                    </td>
                    <td>Phòng</td>
                    <td>
                        <input class="form-control py-2" type="text" size="20" name="TenPhong" value="<?php echo $TenPhong; ?> " disabled="disabled"/></td>
                    </td>
                        
                    </tr>
                   
                    <tr>
                        <td id="no_color" colspan="5" align="center">
                        <input type="submit" value="Xóa" name="delete" class="btn btn-outline-purple deleteDepartmen-btn mb-5 w-25"/>
                        <a class="btn btn-outline-purple editDepartmen-btn mb-5 w-25" href="index.php?page=admin-parameter">Quay Lại</a>
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>     
    </div>
</div>
<?php $this->end(); ?>