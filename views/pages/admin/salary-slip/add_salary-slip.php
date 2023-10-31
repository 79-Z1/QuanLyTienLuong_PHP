<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>

<?php
//Ket noi CSDL
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$getmanv = "SELECT MaNV FROM `nhan_vien` 
order by MaNV";
$resultmanv = mysqli_query($conn, $getmanv);

if (isset($_POST['maPhieu']))
    $maPhieu = trim($_POST['maPhieu']);
else $maPhieu = "";

if (isset($_POST['maNV']))
    $maNV = $_POST['maNV'];


if (isset($_POST['ngayUng']))
    $ngayUng = trim($_POST['ngayUng']);
else $ngayUng = "";

if (isset($_GET['lyDo']))
    $lyDo = trim($_GET['lyDo']);
else $lyDo = "";

if (isset($_GET['soTien']))
    $soTien = trim($_GET['soTien']);
else $soTien = "";

if (isset($_GET['duyet']))
    $duyet = trim($_GET['duyet']);
else $duyet = "";


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
        $sqlInsert = "INSERT INTO `phieu_ung_luong`(`MaPhieu`, `MaNV`, `NgayUng`, `LyDo`, `SoTien`, `Duyet`) VALUES ('$maPhieu','$maNV','$ngayUng','$lyDo',$soTien,' $duyet')";
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
    .td-control {
    
    
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.3;
    color: #16192c;
    background-clip: padding-box;
    border: 1px solid #e7eaf0;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.375rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;

}
</style>
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">THÊM PHIẾU ỨNG LƯƠNG</h5>
            </div>
            <div class="table-responsive">
            <form align='center' action="" method="post" enctype="multipart/form-data">
                <table class="table table-hover table-nowrap">
                    <tr>
                            <td>Mã Phiếu</td>
                        <td>
                        <td>
                            <input class="form-control py-2" type="text" size="20" name="maPhieu" value="<?php echo $maPhieu; ?> " /></td>
                    </td>
                        <td>Mã nhân viên</td>
                        <td>            
                        <select name="maNV" class="form-select search-option">
                               
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
                        <td>Số tiền</td>
                    <td>
                        <td>
                            <input class="td-control py-2" type="text" size="20" name="soTien" value="<?php echo $soTien; ?> " />VND</td>
                        </td>
                        
                        <td >
                                <p>Duyệt</p> 
                            </td>
                            <td><input class="form-control me-2 search-input" type="text" name="duyet" value="<?php echo $duyet; ?>"></td>
                    </tr>

                    <tr>
                    <td>Lý do</td>
                            <td id="no_color">
                                <div class="input-group input-group-lg">
                                 <textarea class="form-control" name="lyDo"  rows="2" maxlength="300" > <?php echo $lyDo;?></textarea>
                                </div>
                            </td>
                        <td>Ngày ứng </td>
                            <td class="<?php if($ngayUng == "") echo 'required'; ?>">
                            <input class="form-date-control py-2" type="date" name="ngayUng" value="<?php echo $ngayUng; ?>" /></td>

                        
                    </tr>
                   
                    <tr>
                        <td id="no_color" colspan="5" align="center">
                        <input type="submit" value="Thêm" name="them" class="btn btn-outline-purple addDepartmen-btn mb-5 w-25"/>
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>     
    </div>
</div>
<?php $this->end(); ?>