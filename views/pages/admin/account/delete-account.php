<?php
$this->layout('layout_admin');
$this->section('content');

include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$conn = mysqli_connect('localhost', 'root', '', 'quan_ly_tien_luong') or die('Could not connect to MySQL: ' . mysqli_connect_error());
$tenTK = $_GET["TenTK"];
$getTaiKhoan = "select * from tai_khoan where TenTK='$tenTK'";
$resultTaiKhoan = mysqli_query($conn, $getTaiKhoan);
$row = mysqli_fetch_array($resultTaiKhoan, MYSQLI_ASSOC);
$matKhau = $row["MatKhau"];
$loaiTK = $row["LoaiTK"];
$maNV = $row["MaNV"];

$getmanv = "SELECT MaNV FROM `nhan_vien` 
    order by MaNV";
    $resultmanv = mysqli_query($conn, $getmanv);

?>
<?php

if (isset($_POST['delete'])) {
    $sqldelete = "delete from tai_khoan where TenTK = '$tenTK'";
    $deleteResult = mysqli_query($conn, $sqldelete);
    if ($deleteResult) {
        echo "<script type='text/javascript'>
            $('#delete').prop('disabled','disabled');
            toastr.success('Xoá thành công');
            setTimeout(function() {
                window.location.href = '/" . explode('/', $_SERVER['PHP_SELF'])[1] . "/views/pages/admin?page=admin-account" . "';
            }, 1500);
            </script>";
    } else {
        echo "<script type='text/javascript'>toastr.error('$error'); toastr.options.timeOut = 1000;</script>";
    }
}
    
?>

<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">XÓA TÀI KHOẢN</h5>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr class="tr">
                            <td>Tên tài khoản</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maCV"
                                    value="<?php echo $row["TenTK"]; ?> " disabled /></td>
                            
                                <td>Mã nhân viên</td>
                                <td><input class="form-control py-2" type="text" size="20" name="maNV"
                                    value="<?php echo $row["MaNV"]; ?> " disabled="disabled" /></td>
                        </tr>
                        <tr class="tr">
                        
                            <td>Mật khẩu</td>
                            <td><input class="form-control py-2" type="text" name="matKhau" value="<?php echo $matKhau; ?> " disabled/></td>

                            <td>Loại tài khoản</td>
                            <td >
                            <input class="form-control py-2" type="text" name="loaiTK" value="<?php echo $loaiTK; ?> " disabled/></td>
                            
                            
                        </tr>
                        <tr>
                        <td id="no_color" align="center" colspan="5">
                        <button class="btn btn-danger deleteTaikhoann-btn mb-5 w-25" 
                        type="button" data-bs-toggle="modal" data-bs-target="#xacnhanxoa">Xoá</button>                       
                                <a class="btn btn-outline-purple deleteTaikhoann-btn mb-5 w-25"
                                    href="index.php?page=admin-account"> Quay Lại</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div><div class="modal fade" id="xacnhanxoa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xoá nhân viên <strong><?php echo $row["TenTK"]; ?></strong> không?</p>
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