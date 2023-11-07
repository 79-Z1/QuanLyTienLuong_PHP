<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>

<?php
//Ket noi CSDL
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");
$sqlPhongBan = 'select * from phong_ban ';
$resultPhongBan = mysqli_query($conn, $sqlPhongBan);

if (isset($_POST['maP']))
    $maP = trim($_POST['maP']);
else $maP = "";

if (isset($_POST['TenPhong']))
    $TenPhong = trim($_POST['TenPhong']);
else $TenPhong = "";

if (isset($_POST['them'])) {

    $err = array();

    if (empty($maP)) {
        $err[] = "Vui lòng nhập mã phòng ban";
    }
    
    if (empty($TenPhong)) {
        $err[] = "Vui lòng nhập tên phòng ban";
    }

    if (empty($err)) {
        $sqlInsert = "INSERT INTO `phong_ban`(`MaPhong`, `TenPhong`) VALUES ('$maP','$TenPhong')";
        $resultInsert = mysqli_query($conn, $sqlInsert);

        if ($resultInsert) {
            echo "<script type='text/javascript'>toastr.success('Thêm phòng ban thành công'); toastr.options.timeOut = 3000;</script>";
            // làm mới giá trị
                $maP = "";
                $tenP = "";
        } else {
            echo "<script type='text/javascript'>toastr.error('Thêm phòng ban không thành công'); toastr.options.timeOut = 3000;</script>";
        }
    } else{
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
                <h5 class="mb-0">THÊM PHÒNG BAN</h5>
            </div>
            <div class="table-responsive">
            <form align='center' action="" method="post" enctype="multipart/form-data">
                <table class="table table-hover table-nowrap">
                    <tr>
                        <td>Mã Phòng</td>
                    <td>
                    <td>
                        <input class="form-control py-2" type="text" size="20" name="maP" value="<?php echo $maP; ?> " /></td>
                    </td>
                    <td>Phòng</td>
                    <td>
                        <input class="form-control py-2" type="text" size="20" name="TenPhong" value="<?php echo $TenPhong; ?> "/></td>
                    </td>
                        
                    </tr>
                   
                    <tr>
                        <td id="no_color" colspan="5" align="center">
                        <input type="submit" value="Thêm" name="them" class="btn btn-outline-purple addDepartmen-btn mb-5 w-25"/>
                        <a class="btn btn-outline-purple addDepartmen-btn mb-5 w-25" href="index.php?page=admin-department">Quay Lại</a>
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>     
    </div>
</div>
<?php $this->end(); ?>