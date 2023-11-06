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


if (isset($_POST['loaiTK']))
    $loaiTK = $_POST['loaiTK'];


if (isset($_POST['MaNV']))
    $maNV = $_POST['MaNV'];


if (isset($_POST['edit'])) {
    $err = array();
    
    if (empty($matKhau)) {
        $err[] = "Vui lòng nhập mật khẩu";
    }
    if (empty($loaiTK)) {
        $err[] = "Vui lòng nhập loại tài khoản";
    }
    if (empty($maNV)) {
        $err[] = "Vui lòng nhập mã nhân viên";
    }
    // if (empty($HSL)) {
    //     $err[] = "Vui lòng nhập hệ số lương";
    // } elseif (!is_numeric($HSL)) {
    //     $err[] = "Hệ số lương phải là một số";
    // }

    if (empty($err)) {
        $tenTK = $_GET['TenTK'];
        $loaiTK = $_POST['loaiTK'];
        $maNV = $_POST['maNV'];
        $sqlupdate = "UPDATE `tai_khoan` SET `TenTK`='$tenTK',`MatKhau`='$matKhau',`LoaiTK`='$loaiTK',`MaNV`='$maNV'
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
                                <td>            
                                <select name="maNV" class="form-select search-option">
                                        <?php
                                        if (mysqli_num_rows($resultmanv ) <> 0) {

                                            while ($rows = mysqli_fetch_array($resultmanv )) {
                                                echo "<option value='$rows[MaNV]'";
                                                if (isset($_POST['MaNV']) && $_POST['MaNV'] == $rows['MaNV'] || $rows['MaNV']==$row['MaNV'] ) echo "selected";
                                                echo ">$rows[MaNV]</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                        </tr>
                        <tr class="tr">
                        
                            <td>Mật khẩu</td>
                            <td><input class="form-control py-2" type="text" name="matKhau" value="<?php echo $matKhau; ?> " /></td>

                            <td>Loại tài khoản</td>
                            <td >
                            <select class="form-select search-option" name="loaiTK" >
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