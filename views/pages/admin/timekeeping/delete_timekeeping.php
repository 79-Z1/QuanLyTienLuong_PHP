<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>
<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

        $conn = mysqli_connect ('localhost', 'root', '', 'quan_ly_tien_luong') 
        OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
    $macong = $_GET["MaCong"];
    $getChamCong = "select * from cham_cong where MaCong='$macong'";   
    $resultChamCong = mysqli_query($conn, $getChamCong);
    $row = mysqli_fetch_array($resultChamCong, MYSQLI_ASSOC);

    $getmanv = "SELECT MaNV FROM `nhan_vien` 
    order by MaNV";
    $resultmanv = mysqli_query($conn, $getmanv);


    if (isset($_POST['delete'])) {
        $sqldelete = "delete from cham_cong 
        where MaCong = '$_GET[MaCong]'";
        $deleteResult = mysqli_query($conn, $sqldelete);
        echo "<script type='text/javascript'>
        $('#delete').prop('disabled','disabled');
        toastr.success('Xoá thành công');
        setTimeout(function() {
            window.location.href = '/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/admin?page=admin-timekeeping" . "';
        }, 1500);
        </script>";
    }
    if(isset($_POST["tinhTrang"])) {
        $tinhTrang = trim($_POST['tinhTrang']) ;
    
    }
    else $tinhTrang = $row['TinhTrang'];

    if(isset($_POST["nghiHL"])) {
        $nghiHL = trim($_POST['nghiHL']);
    }
    else $nghiHL = $row['NghiHL'];
    if(isset($_POST["ngay"])) {
        $ngay = $_POST['ngay'];
    }
    else $ngay = $row['Ngay'];

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

<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">XÓA CHẤM CÔNG</h5>
            </div>
            <div class="table-responsive">
            <form align='center' action="" method="post" enctype="multipart/form-data">
                <table class="table table-hover table-nowrap">
                    <tr>
                    <td>Mã Công</td>                    
                    <td> 
                        <input class="form-control py-2" type="text" size="20" name="maP" value="<?php echo $row["MaCong"]; ?> "disabled/></td>
                    </td>
                    <td>Mã Nhân Viên</td>
                    <td>                    
                            <input class="form-control py-2" type="text" size="20" name="MaNV" value="<?php echo $row["MaNV"]; ?> "disabled/></td>
                    </td>
                        
                    </tr>
                    <tr>
                            <td>
                                <p>Tình trạng</p>
                            </td>
                            <td class="<?php if($tinhTrang == "") echo 'required'; ?>"><input class="form-control me-2 search-input" type="text" name="tinhTrang" value="<?php echo $tinhTrang; ?>"disabled></td>
                            
                            <td>
                                <p>Nghỉ hưởng lương</p>
                            </td>
                            <td class="<?php if($nghiHL == "") echo 'required'; ?>"><input class="form-control me-2 search-input" type="text" name="nghiHL" value="<?php echo $nghiHL; ?>"disabled></td>
                        </tr>

                        <tr>
                            <td>Ngày</td>
                            <td class="<?php if($ngay == "") echo 'required'; ?>">
                            <input class="form-date-control py-2" type="date" name="ngay" value="<?php echo $ngay; ?>" disabled/></td>
                        </tr>
                    <tr>
                    
                        <td id="no_color" colspan="5" align="center">
                        <input type="submit" value="Xóa" name="delete" class="btn btn-outline-purple deleteTimekeeping-btn mb-5 w-25"/>
                        <a class="btn btn-outline-purple themnhanvien-btn mb-5 w-25"
                                    href="index.php?page=admin-timekeeping"> Quay Lại</a>
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>     
    </div>
</div>
<?php $this->end(); ?>