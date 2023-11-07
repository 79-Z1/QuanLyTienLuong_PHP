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


if (isset($_POST['matKhau']))
    $matKhau = trim($_POST['matKhau']);


if (isset($_POST['loaiTK'])){
    $loaiTK = $_POST['loaiTK'];
} else $loaiTK = $row['LoaiTK'];


if (isset($_POST['edit'])) {
    $err = array();
    
    if (empty($matKhau)) {
        $err[] = "Vui lòng nhập mật khẩu";
    }
    if (empty($loaiTK)) {
        $err[] = "Vui lòng nhập loại tài khoản";
    }
    

    if (empty($err)) {
        $tenTK = $_GET['TenTK'];
        $loaiTK = $_POST['loaiTK'];
        $sqlupdate = "UPDATE `tai_khoan` SET `MatKhau`='$matKhau',`LoaiTK`='$loaiTK'
        WHERE TenTK='$tenTK'";
        
        $resultupdate = mysqli_query($conn, $sqlupdate);
        
        echo "<script type='text/javascript'>toastr.success('sửa tài khoản thành công'); toastr.options.timeOut = 3000;</script>";
    } else {
        foreach ($err as $error) {
            echo "<script type='text/javascript'>toastr.error('$error'); toastr.options.timeOut = 3000;</script>";
        }
    }
}
?>

<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">CHỈNH SỬA TÀI KHOẢN</h5>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr class="tr">
                            <td>Tên tài khoản</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maCV"
                                    value="<?php echo $row["TenTK"]; ?> " disabled /></td>
                            
                                <td>Mã nhân viên</td>
                                <td><input class="form-control py-2" type="text" size="20" name="MaNV"
                                    value="<?php echo $row["MaNV"]; ?> " disabled /></td>
                        </tr>
                        <tr class="tr">
                        
                            <td>Mật khẩu</td>
                            <td><input class="form-control py-2" type="text" name="matKhau" value="<?php echo $matKhau; ?> " /></td>

                            <td>Loại tài khoản</td>
                            <td >
                            <select class="form-select search-option" name="loaiTK" >
                               
                                    <option value="AD" <?php if($loaiTK == 'AD') echo " selected"; ?>>Người Quản Trị</option>
                                    <option value="QL" <?php if($loaiTK == 'QL') echo " selected"; ?>>Quản Lí</option>
                                    <option value="KT" <?php if($loaiTK == 'KT') echo " selected"; ?>>Kế Toán</option>
                                    <option value="NV" <?php if($loaiTK == 'NV') echo " selected"; ?>>Nhân viên</option>                                    
                                    
                            </select>
                            </td>
                            
                            
                        </tr>
                        <tr>
                        <td id="no_color" align="center" colspan="5">
                                <input type="submit" value="Lưu" name="edit"
                                    class="btn btn-outline-purple editTaikhoann-btn mb-5 w-25" />
                                <a class="btn btn-outline-purple editTaikhoann-btn mb-5 w-25"
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