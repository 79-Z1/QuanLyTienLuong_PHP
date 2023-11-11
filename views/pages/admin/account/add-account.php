<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>

<?php
//Ket noi CSDL
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");





$getmanv = "SELECT MaNV FROM `nhan_vien` 
order by MaNV";
$resultmanv = mysqli_query($conn, $getmanv);

function CheckTenTK($conn, $tenTK){
    $sqlTenTK= "select * from tai_khoan where TenTK = '$tenTK' ";
    $resulTenTK = mysqli_query($conn, $sqlTenTK);

    if(mysqli_num_rows($resulTenTK) > 0){
        return true;
    }return false;
}

if (isset($_POST['tenTK']))
    $tenTK = trim($_POST['tenTK']);
else $tenTK = "";

if (isset($_POST['matKhau']))
    $matKhau = trim($_POST['matKhau']);
else $matKhau = "";

if (isset($_POST['loaiTK']))
    $loaiTK = $_POST['loaiTK'];
else $loaiTK = "";

if (isset($_POST['maNV']))
    $maNV = $_POST['maNV'];
else $maNV = "";


if (isset($_POST['them'])) {

    $err = array();

    if (empty($tenTK)) {
        $err[] = "Vui lòng nhập tên tài khoản";
    }
    if(CheckTenTK($conn, $tenTK)) {
        $err[] = "Đã có tên tài khoản này rồi!!";
    }
    if (empty($matKhau)) {
        $err[] = "Vui lòng nhập mật khẩu";
    }
    if (empty($loaiTK)) {
        $err[] = "Vui lòng nhập loại tài khoản";
    }
    if (empty($maNV)) {
        $err[] = "Vui lòng nhập mã nhân viên";
    }
    // if (!empty($HSL) && !is_numeric($HSL)) {
    //     $err[] = "Hệ số lương phải là một số";
    // }

    if (empty($err)) {
        $sqlInsert = "INSERT INTO `tai_khoan`(`TenTK`, `MatKhau`, `LoaiTK`, `MaNV`)
                            VALUES ('$tenTK','$matKhau','$loaiTK','$maNV')";
        $resultInsert = mysqli_query($conn, $sqlInsert);

        if ($resultInsert) {
            echo "<script type='text/javascript'>toastr.success('thêm thành công'); toastr.options.timeOut = 3000;</script>";
            // làm mới giá trị
            $tenTK = "";
            $matKhau = ""; 
            $loaiTK = "";
            $maNV = "";
           
        } else {
            // echo "Lỗi: " . mysqli_error($conn);
            echo "<script type='text/javascript'>toastr.error('thêm không thành công'); toastr.options.timeOut = 3000;</script>";
        }
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
                <h5 class="mb-0">THÊM TÀI KHOẢN</h5>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr class="tr">
                            <td>Tên tài khoản</td>
                            <td><input class="form-control py-2" type="text" size="20" name="tenTK" value="<?php echo $tenTK; ?> " /></td>                  
                            <td>Mã nhân viên</td>
                                <td>            
                                <select name="maNV" class="form-select search-option">               
                                        <?php
                                        if (mysqli_num_rows($resultmanv ) <> 0) {
                                            while ($rows = mysqli_fetch_array($resultmanv )) {
                                                echo "<option value='$rows[MaNV]'";
                                                if (isset($_POST['maNV']) && $_POST['maNV'] == $rows['MaNV']) echo "selected";
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
                                <input type="submit" value="Thêm" name="them" class="btn btn-outline-purple themtaikhoan-btn mb-5 w-25" />
                                <a class="btn btn-outline-purple themtaikhoan-btn mb-5 w-25" href="index.php?page=admin-account"> Quay Lại</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->end(); ?>