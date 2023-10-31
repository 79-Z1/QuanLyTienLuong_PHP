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

    // if (isset($_POST['edit'])) {
    //     $err = array();
        
    //     if (empty($MaNV)) {
    //         $err[] = "Vui lòng nhập tên chức vụ";
    //     }
    //     if (empty($ngayUng)) {
    //         $err[] = "Vui lòng nhập tên chức vụ";
    //     }
    //     if (empty($lyDo)) {
    //         $err[] = "Vui lòng nhập tên chức vụ";
    //     }
    //     if (empty($soTien)) {
    //         $err[] = "Vui lòng nhập hệ số lương";
    //     } elseif (!is_numeric($duyet)) {
    //         $err[] = "Hệ số lương phải là một số";
    //     }
    
    //     if (empty($err)) {
    //         $sqlupdate = "UPDATE `phieu_ung_luong` SET `MaNV`='$MaNV',`NgayUng`='$ngayUng',`LyDo`='$lyDo', `SoTien`=$soTien ,`Duyet`='$duyet'
    //         WHERE MaPhieu='$maPhieu'";
    //         $resultupdate = mysqli_query($conn, $sqlupdate);
    //         $MaNV = $_POST['MaNV'];
    //         $ngayUng = $_POST['ngayUng'];
    //         $lyDo = $_POST['lyDo'];
    //         $soTien = $_POST['soTien'];
    //         $duyet = $_POST['duyet'];
    //         echo "<script>";
    //         echo "alert('Chỉnh sữa chức vụ thành công');";
    //         echo "</script>";
    //     } else {
    //         echo "<script>";
    //         foreach ($err as $error) {
    //             echo "alert('$error');";
    //         }
    //         echo "</script>";
    //     }
    // }
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
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>     
    </div>
</div>
<?php $this->end(); ?>