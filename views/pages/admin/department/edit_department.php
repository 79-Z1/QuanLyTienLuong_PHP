<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

        $conn = mysqli_connect ('localhost', 'root', '', 'quan_ly_tien_luong') 
        OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
    $maP = $_GET["MaPhong"];
    $getPhongBan = "select MaPhong, TenPhong from phong_ban where MaPhong='$maP'";   
    $resultPhongBan = mysqli_query($conn, $getPhongBan);
    $row = mysqli_fetch_array($resultPhongBan, MYSQLI_ASSOC);
    $TenPhong = $row["TenPhong"];




    if (isset($_POST['edit'])) {
        $err = array();
        
        if (empty($maP)) {
            $err[] = "Vui lòng nhập mã phòng";
        }
        if (empty($TenPhong)) {
            $err[] = "Vui lòng nhập tên phòng";
        }

    
        if (empty($err)) {
            $sqlupdate = "UPDATE `phong_ban` SET `MaPhong`='$maP',`TenPhong`='$TenPhong'
            WHERE MaPhong='$maP'";
            $resultupdate = mysqli_query($conn, $sqlupdate);
            $maP = $_GET['MaPhong'];
            $TenPhong = $_POST['TenPhong'];

            echo "<script type='text/javascript'>toastr.success('Sửa thành công'); toastr.options.timeOut = 3000;</script>";
        } else {
            echo "<script>";
            foreach ($err as $error) {
                echo "<script type='text/javascript'>toastr.error('$error'); toastr.options.timeOut = 3000;</script>";
            }
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
        padding-left: 50px;
    } 
    /* tbody{
        
        font-weight: bold;
        height: 597px;
    } */
</style>
<?php
    if(isset($_POST["TenPhong"])) {
        $TenPhong = $_POST['TenPhong'];
    }
    if (isset($_POST['edit'])) {
        if($TenPhong != ''){
            $sqlupdate = "UPDATE `phong_ban` SET `TenPhong`='$TenPhong' WHERE MaPhong='$maP'";
            $resultupdate = mysqli_query($conn, $sqlupdate);
            $TenPhong = $_POST['TenPhong'];
        }
    }
?>
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">CHỈNH SỬA PHÒNG BAN</h5>
            </div>
            <div class="table-responsive">
            <form align='center' action="" method="post" enctype="multipart/form-data">
                <table class="table table-hover table-nowrap">
                    <tr>
                    <td>Mã Phòng</td>                    
                    <td> 
                        <input class="form-control py-2" type="text" size="20" name="maP" value="<?php echo $row["MaPhong"]; ?> "disabled/></td>
                    </td>
                    <td>Phòng</td>
                    <td>
                        <input class="form-control py-2" type="text" size="20" name="TenPhong" value="<?php echo $TenPhong; ?> " /></td>
                        
                    </td>
                        
                    </tr>
                   
                    <tr>
                    
                        <td id="no_color" colspan="5" align="center">
                        <input type="submit" value="Chỉnh sửa" name="edit" class="btn btn-outline-purple editDepartmen-btn mb-5 w-25"/>
                        <a class="btn btn-outline-purple editDepartmen-btn mb-5 w-25" href="index.php?page=admin-department">Quay Lại</a>
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>     
    </div>
</div>
<?php $this->end(); ?>