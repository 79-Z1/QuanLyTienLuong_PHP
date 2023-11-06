<?php
$this->layout('layout_admin');
$this->section('content');

include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$conn = mysqli_connect('localhost', 'root', '', 'quan_ly_tien_luong') or die('Could not connect to MySQL: ' . mysqli_connect_error());
$maCV = $_GET["maCV"];
$getChucVu = "select * from chuc_vu where MaChucVu='$maCV'";
$resultChucVu = mysqli_query($conn, $getChucVu);
$row = mysqli_fetch_array($resultChucVu, MYSQLI_ASSOC);
$tenCV = $row["TenChucVu"];
$HSL = $row["HeSoLuong"];

if (isset($_POST["tenCV"])) {
    $tenCV = $_POST['tenCV'];
}
if (isset($_POST["HSL"])) {
    $HSL = $_POST['HSL'];
}
if (isset($_POST['edit'])) {
    $err = array();
    
    if (empty($tenCV)) {
        $err[] = "Vui lòng nhập tên chức vụ";
    }
    if (empty($HSL)) {
        $err[] = "Vui lòng nhập hệ số lương";
    } elseif (!is_numeric($HSL)) {
        $err[] = "Hệ số lương phải là một số";
    }

    if (empty($err)) {
        $sqlupdate = "UPDATE `chuc_vu` SET `MaChucVu`='$maCV',`TenChucVu`='$tenCV',`HeSoLuong`='$HSL' WHERE MaChucVu='$maCV'";
        $resultupdate = mysqli_query($conn, $sqlupdate);
        echo "<script type='text/javascript'>toastr.success('Sửa thành công'); toastr.options.timeOut = 3000;</script>";
    } else {
        foreach ($err as $error) {
            echo "<script type='text/javascript'>toastr.error(' $error'); toastr.options.timeOut = 3000;</script>";
        }
    }
}
?>

<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">SỬA CHỨC VỤ</h5>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr class="tr">
                            <td>Mã chức vụ</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maCV"
                                    value="<?php echo $row["MaChucVu"]; ?> " disabled /></td>
                            <td>Hệ số lương</td>
                            <td><input class="form-control py-2" type="text" name="HSL"
                                    value="<?php echo $HSL; ?>" /></td>
                        </tr>
                        <tr class="tr">
                            <td>Tên chức vụ </td>
                            <td><input class="form-control py-2" type="text" size="20" name="tenCV"
                                    value="<?php echo $tenCV; ?>" /></td>
                            <td id="no_color" colspan="2">
                                <input type="submit" value="Lưu" name="edit"
                                    class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" />
                                <a class="btn btn-outline-purple themnhanvien-btn mb-5 w-25"
                                    href="index.php?page=admin-position"> Quay Lại</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->end(); ?>