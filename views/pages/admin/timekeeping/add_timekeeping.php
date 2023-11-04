<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>

<?php
//Ket noi CSDL
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$getmanv = "SELECT MaNV FROM `nhan_vien` 
order by MaNV";
$resultmanv = mysqli_query($conn, $getmanv);

if (isset($_POST['maCong']))
    $maCong = trim($_POST['maCong']);
else $maCong = "";

if (isset($_POST['maNV']))
    $maNV = trim($_POST['maNV']);
else $maNV = "";

if (isset($_POST['tinhTrang']))
    $tinhTrang = trim($_POST['tinhTrang']);
else $tinhTrang = "";

if (isset($_GET['ngay']))
    $ngay = $_GET['ngay'];
else $ngay = "";

if (isset($_GET['nghiHL']))
    $nghiHL = $_GET['nghiHL'];
else $nghiHL = "";


if (isset($_POST['them'])) {

    $err = array();

    // if (empty($maCong)) {
    //     $err[] = "Vui lòng nhập mã phòng ban";
    // }
    // if (empty($maNV)) {
    //     $err[] = "Vui lòng nhập mã nhân viên";
    // }
    // if (empty($tinhTrang)) {
    //     $err[] = "Vui lòng nhập tình trạng";
    // }
    // if (empty($ngay)) {
    //     $err[] = "Vui lòng nhập ngày";
    // }
    // if (empty($nghiHL)) {
    //     $err[] = "Vui lòng nhập nghỉ hưởng lương";
    // }

    if (empty($err)) {
        $sqlInsert = "INSERT INTO `cham_cong`(`MaCong`, `MaNV`, `TinhTrang`, `Ngay`, `NghiHL`) VALUES ('$maCong','$maNV','$tinhTrang','$ngay','$nghiHL')";
        $resultInsert = mysqli_query($conn, $sqlInsert);

        if ($resultInsert) {
            echo "<script>";
            echo "alert('Thêm chấm công thành công')";
            echo "</script>";
            // làm mới giá trị
            $maP = "";
            $tenP = "";
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    } else{

        echo "<script>";
        foreach ($err as $error) {
            echo "alert('$error');";
        }
        echo "</script>";
    }
}
?>
<style>
    .form-control.form-select{
        padding-top: 0.3rem !important;
        padding-bottom: 0.3rem !important;
        
    }
    .form-date-control{  
        width: 70%;
    }
</style>
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">THÊM CHẤM CÔNG</h5>
            </div>
            <div class="table-responsive">
            <form align='center' action="" method="post" enctype="multipart/form-data">
                <table class="table table-hover table-nowrap">
                    <tr>
                            <td>Mã Công</td>
                        <td>
                        <td>
                            <input class="form-control py-2" type="text" size="20" name="maCong" value="<?php echo $maCong; ?> " /></td>
                    </td>
                        <td>Mã nhân viên</td>
                        <td>            
                        <select name="maNV" class="form-select search-option">
                                <option value="">Trống</option>
                                <?php
                                if (mysqli_num_rows($resultmanv ) <> 0) {

                                    while ($rows = mysqli_fetch_array($resultmanv )) {
                                        echo "<option value='$rows[MaNV]'";
                                        if (isset($_GET['MaNV']) && $_GET['MaNV'] == $rows['MaNV']) echo "selected";
                                        echo ">$rows[MaNV]</option>";
                                    }
                                }
                                ?>
                            </select>
                    </td>
                    </tr>

                    <tr>
                        <td>Tình trạng</td>
                    <td>
                        <td>
                            <input class="form-control py-2" type="text" size="20" name="tinhTrang" value="<?php echo $tinhTrang; ?> " /></td>
                        </td>
                        <td>Nghỉ Hưởng Lương</td>
                        <td>
                            <input class="form-control py-2" type="text" size="20" name="nghiHL" value="<?php echo $nghiHL; ?> "/></td>
                        </td>
                    </tr>

                    <tr>
                        <td>Ngày</td>
                            <td class="<?php if($ngay == "") echo 'required'; ?>">
                            <input class="form-date-control py-2" type="date" name="ngay" value="<?php echo $ngay; ?>" /></td>
                    </tr>
                   
                    <tr>
                        <td id="no_color" colspan="5" align="center">
                        <input type="submit" value="Thêm" name="them" class="btn btn-outline-purple addDepartmen-btn mb-5 w-25"/>
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