<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$maTS = $_GET["maTS"];
$getThamSo = "select * from tham_so where MaTS='$maTS'";
$resultThamSo = mysqli_query($conn, $getThamSo);
$row = mysqli_fetch_array($resultThamSo, MYSQLI_ASSOC);
$tenTS = $row["TenTS"];
$DVT = $row["DVT"];
$giaTri = $row["GiaTri"];
$tinhTrang = $row["TinhTrang"];

if (isset($_POST["tenTS"])) {
    $tenTS = $_POST['tenTS'];
}
if (isset($_POST["DVT"])) {
    $DVT = $_POST['DVT'];
}
if (isset($_POST["giaTri"])) {
    $giaTri = $_POST['giaTri'];
}
if (isset($_POST["tinhTrang"])) {
    $tinhTrang = $_POST['tinhTrang'];
}



if (isset($_POST['edit'])) {
    
    $err = array();
    if (empty($tenTS)) {
        $err[] = "Vui lòng nhập tên tham số";
    }
    if (empty($DVT)) {
        $err[] = "Vui lòng nhập đơn vị tính";
    }
    if (empty($giaTri) && $giaTri != 0) {
        $err[] = "Vui lòng nhập giá trị";
    } else if(!is_numeric($giaTri)) {
        $err[] = "Giá trị phải là số";
    }
    if($tinhTrang != 1 && $tinhTrang != 0 ){
        $err[] = "Tình trạng chỉ có 0 và 1";
    }

    if (empty($err)) {
        $sqlupdate = "UPDATE `tham_so` SET `MaTS`='$maTS',`TenTS`='$tenTS',`DVT`='$DVT',`GiaTri`='$giaTri',`TinhTrang`=$tinhTrang WHERE MaTS = '$maTS'";

        $resultupdate = mysqli_query($conn, $sqlupdate);
        echo "<script type='text/javascript'>toastr.success('Sửa thành công'); toastr.options.timeOut = 3000;</script>";

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
                <h3 class="mb-0">SỬA THAM SỐ</h3>
            </div>
            <div class="table-responsive">
                <form align='center' action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover table-nowrap">
                        <tr class="tr">
                            <td>Mã tham số</td>
                            <td><input class="form-control py-2" type="text" size="20" name="maTS" value="<?php echo $row["MaTS"]; ?>" disabled/></td>
                            <td>Tên tham số</td>
                            <td><input class="form-control py-2" type="text" size="20" name="tenTS" value="<?php echo $tenTS; ?>" /></td>
                        </tr>
                        <tr class="tr">
                            <td>Đơn vị tính </td>
                            <td>
                            <input class="form-control py-2" type="text" size="20" name="DVT" value="<?php echo $DVT; ?>" />
                            </td>
                            <td>Giá trị</td>
                            <td>
                                <input class="form-control py-2" type="text" size="20" name="giaTri" value="<?php echo $giaTri; ?>" />
                            </td>
                        </tr>
                        <tr class="tr">
                            <td>Tình trạng</td>
                            <td>
                            <select name="tinhTrang" class="form-select search-option">
                                    <option value="0" <?php if ($tinhTrang == '0') echo " selected"; ?>>Chưa sử dụng</option>
                                    <option value="1" <?php if ($tinhTrang == '1') echo " selected"; ?>>Đã sử dụng</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="tr">
                            <td id="no_color" align="center" colspan="4">
                                <input type="submit" value="Lưu" name="edit" class="btn btn-outline-success me-3 themnhanvien-btn mb-5 w-25" />
                                <a class="btn btn-outline-purple themnhanvien-btn mb-5 w-25" href="index.php?page=admin-parameter">Quay Lại</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->end(); ?>