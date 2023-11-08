<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>

<?php
//Ket noi CSDL
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$getmanv = "SELECT MaNV FROM `nhan_vien` 
order by MaNV";
$resultmanv = mysqli_query($conn, $getmanv);

$sqlMaCong = "select * from cham_cong";
$resultMaCong = mysqli_query($conn, $sqlMaCong);
$row = mysqli_fetch_array($resultMaCong);

if (isset($_POST['maCong']))
    $maCong = trim($_POST['maCong']);
else $maCong = "";

if (isset($_POST['maNV']))
    $maNV = trim($_POST['maNV']);

if (isset($_POST['tinhTrang']))
    $tinhTrang = trim($_POST['tinhTrang']);
else $tinhTrang = "";

if (isset($_POST['ngay']))
    $ngay = $_POST['ngay'];
else $ngay = "";

if (isset($_POST['nghiHL']))
    $nghiHL = $_POST['nghiHL'];
else $nghiHL = "";


if (isset($_POST['them'])) {

    $err = array();

    if (empty($maCong)) {
        $err[] = "Vui lòng nhập mã công";
    }else if($maCong == $row["MaCong"]) {
        $err[] = "Đã có mã công này rồi!!";
    }
    if (empty($maNV)) {
        $err[] = "Vui lòng nhập mã nhân viên";
    }
    if (!is_numeric($tinhTrang)) {
        $err[] = "Vui lòng nhập tình trạng";
    } 
    if($tinhTrang > 1 ){
        $err[] = "Tình trạng chỉ có 0 và 1";
    }
    if (empty($ngay)) {
        $err[] = "Vui lòng nhập ngày";
    }
    

    if (empty($err)) {
        $sqlInsert = "INSERT INTO `cham_cong`(`MaCong`, `MaNV`, `TinhTrang`, `Ngay`, `NghiHL`) VALUES ('$maCong','$maNV',$tinhTrang,'$ngay',$nghiHL)";
        $resultInsert = mysqli_query($conn, $sqlInsert);

        if ($resultInsert) {
            echo "<script type='text/javascript'>toastr.success('thêm thành công'); toastr.options.timeOut = 3000;</script>";
        }
        else{
            // echo "Lỗi: " . mysqli_error($conn);
            echo "<script type='text/javascript'>toastr.error('thêm không thành công'); toastr.options.timeOut = 3000;</script>";
            }  
        }else {
        foreach ($err as $error) {
            echo "<script type='text/javascript'>toastr.error('$error'); toastr.options.timeOut = 3000;</script>";
        }
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
    tr td {
    font-size: 20px !important;
    height: 20% !important;
    font-weight: bold;
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
                        <td><p>Mã Công</p></td>
                        <td>
                            <input class="form-control py-2" type="text" size="20" name="maCong" value="<?php echo $maCong; ?> " />
                        </td>
                        
                        <td><p>Mã nhân viên</p></td>
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

                    <tr>
                        <td>Tình trạng</td>
                    
                        <td>
                             <select name="tinhTrang" class="form-select search-option">
                                    <option value="0" <?php if (isset($_POST['tinhTrang']) && $_POST['tinhTrang'] == '0') echo " selected"; ?>>Nghỉ</option>
                                    <option value="1" <?php if (isset($_POST['tinhTrang']) && $_POST['tinhTrang'] == '1') echo " selected"; ?>>Đi làm</option>
                            </select>        
                        </td>

                        <td>Nghỉ Hưởng Lương</td>
                        <td>
                             <select name="nghiHL" class="form-select search-option">
                                    <option value="0" <?php if (isset($_POST['nghiHL']) && $_POST['nghiHL'] == '0') echo " selected"; ?>>Không hưởng lương</option>
                                    <option value="1" <?php if (isset($_POST['nghiHL']) && $_POST['nghiHL'] == '1') echo " selected"; ?>>Có hưởng lương</option>
                                </select>        
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
                        <a class="btn btn-outline-purple addDepartmen-btn mb-5 w-25"
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