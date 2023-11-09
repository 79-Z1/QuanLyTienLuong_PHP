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
    
    function checkPB($conn,$maP){
        $sqlMaP = "select * from nhan_vien where MaPhong = '$maP' ";
        $resultMaP = mysqli_query($conn, $sqlMaP);
    
        if(mysqli_num_rows($resultMaP) > 0){
            return true;
        }return false;
    } 

    if (isset($_POST['delete'])) {
        if (!checkPB($conn,$maP)) {
        $sqldelete = "delete from phong_ban 
        where MaPhong = '$_GET[MaPhong]'";
        $deleteResult = mysqli_query($conn, $sqldelete);
        echo "<script type='text/javascript'>
        $('#delete').prop('disabled','disabled');
        toastr.success('Xoá thành công');
        setTimeout(function() {
            window.location.href = '/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/admin?page=admin-department" . "';
        }, 1500);
        </script>";
        }else{
            echo "<script type='text/javascript'>toastr.error('Hiện vẫn còn nhân viên ở phòng này, Không thể xóa!!'); toastr.options.timeOut = 3000;</script>";
        }
    }
    if(isset($_POST["maP"])) {
        $maP = trim($_POST['maP']) ;
    }
    else $maP = $row['MaPhong'];

    if(isset($_POST["TenPhong"])) {
        $TenPhong = trim($_POST['TenPhong']);
    }else $TenPhong = $row['TenPhong'];
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
                        <button class="btn btn-danger deleteDepartmen-btn mb-5 w-25" type="button" data-bs-toggle="modal" data-bs-target="#xacnhanxoa">Xoá</button>    
                        <a class="btn btn-outline-purple deleteDepartmen-btn mb-5 w-25" href="index.php?page=admin-department">Quay Lại</a>
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>     
    </div>
</div>
<div class="modal fade" id="xacnhanxoa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xoá phòng ban <strong><?php echo $row["MaPhong"]; ?></strong> không?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <form action="" method="post">
                    <input id="delete" class="btn btn-danger" type="submit" value="Xoá" name="delete" />
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->end(); ?>