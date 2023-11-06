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
                            <select class="form-control py-2" name="loaiTK" disabled >
                                <optgroup>
                                    <option value="AD">Người Quản Trị</option>
                                    <option value="QL">Quản Lí</option>
                                    <option value="KT">Kế Toán</option>
                                    <option value="NV">Nhân viên</option>                                    
                                </optgroup>
                            </select>
                            </td>
                            
                            
                        </tr>
                        <tr>
                        <td id="no_color" align="center" colspan="5">
                                <input type="submit" value="Xóa" name="delete"
                                    class="btn btn-outline-purple deleteTaikhoann-btn mb-5 w-25" />
                                <a class="btn btn-outline-purple deleteTaikhoann-btn mb-5 w-25"
                                    href="index.php?page=admin-account"> Quay Lại</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->end(); ?>