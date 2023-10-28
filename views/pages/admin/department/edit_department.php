<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

        $conn = mysqli_connect ('localhost', 'root', '', 'quan_ly_tien_luong') 
		OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
    $maP = $_GET["MaPhong"];
    $getPhongBan = "select MaPhong, TenPhong from phong_ban
    where MaPhong='$maP'";   
    $resultPhongBan = mysqli_query($conn, $getPhongBan );
    $row = mysqli_fetch_array($resultPhongBan, MYSQLI_ASSOC);
    $ph = mysqli_fetch_array($resultPhongBan );
    

    $err = array();

    $allowed = array('image/jpeg','image/png');

    // connect mysql

    $getPhongBan = "select * from phong_ban";
    $resultPhongBan = mysqli_query($conn, $getPhongBan);
?>
<style>
    .form-control.form-select{
        padding-top: 0.3rem !important;
        padding-bottom: 0.3rem !important;
        
    }
    .form-select{
        width: 100%;
        padding-left: 50px;
    } 
    /* tbody{
        
        font-weight: bold;
        height: 597px;
    } */
</style>
<?php
    if (isset($_POST['name']))
    $name = trim($_POST['name']);
    else $name = $ph['TenPhong'];

    if (isset($_POST['capnhat'])) {
        if($name != ''&& $stt != ''){
            $sqlupdate = "UPDATE `phong_ban` SET `MaPhong`='$stt',`TenPhong`='$name' WHERE phong_ban='$_GET[maP]'";
            $resultupdate = mysqli_query($conn, $sqlupdate);
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
                        <td>
                        <input class="form-control py-2" type="text" size="20" name="maP" value="<?php echo $row["MaPhong"]; ?> "disabled/></td>
                        </td>
                    </td>
                    <td>Phòng</td>
                    <td>
                        <input class="form-control py-2" type="text" size="20" name="TenPhong" value="<?php echo $row["TenPhong"]; ?> " /></td>
                    </td>
                        
                    </tr>
                   
                    <tr>
                        <td id="no_color" colspan="5" align="center">
                        <input type="submit" value="Chỉnh sửa" name="edit" class="btn btn-outline-purple editDepartmen-btn mb-5 w-25"/>
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>     
    </div>
</div>
<?php $this->end(); ?>