<?php $this->layout('layout_admin') ?>
<?php $this->section('content'); ?>

<?php
//Ket noi CSDL
include_once($_SERVER['DOCUMENT_ROOT'] . '/' . explode('/', $_SERVER['PHP_SELF'])[1] . "/connect.php");

$getmanv = "SELECT MaNV FROM `nhan_vien` 
order by MaNV";
$resultmanv = mysqli_query($conn, $getmanv);

$sqlMaPhieu = "select * from phieu_ung_luong where 1";
$resultMaPhieu = mysqli_query($conn, $sqlMaPhieu);

function CheckMaPhieu($conn, $maPhieu){
    $sqlMaPhieu = "select * from phieu_ung_luong where MaPhieu = '$maPhieu' ";
    $resultMaPhieu = mysqli_query($conn, $sqlMaPhieu);

    if(mysqli_num_rows($resultMaPhieu) > 0){
        return true;
    }return false;
}

if (isset($_POST['maPhieu']))
    $maPhieu = trim($_POST['maPhieu']);
else $maPhieu = "";

if (isset($_POST['maNV']))
    $maNV = $_POST['maNV'];


if (isset($_POST['ngayUng']))
    $ngayUng = trim($_POST['ngayUng']);
else $ngayUng = "";

if (isset($_POST['lyDo']))
    $lyDo = trim($_POST['lyDo']);
else $lyDo = "";

if (isset($_POST['soTien']))
    $soTien = trim($_POST['soTien']);
else $soTien = "";

if (isset($_POST['duyet']))
    $duyet = trim($_POST['duyet']);
else $duyet = "";


if (isset($_POST['them'])) {

    $err = array();

    if (empty($maPhieu)) {
        $err[] = "Vui lòng nhập mã phiếu ứng lương";
    }
    if(CheckMaPhieu($conn, $maPhieu)) {
        $err[] = "Đã có mã phiếu này rồi!!";
    }

    if (empty($maNV)) {
        $err[] = "Vui lòng nhập mã nhân viên";
    }
    if (empty($ngayUng)) {
        $err[] = "Vui lòng nhập ngày ứng lương";
    }
    if (empty($lyDo)) {
        $err[] = "Vui lòng nhập lý do muốn ứng";
    }
    if (empty($soTien)) {
        $err[] = "Vui lòng nhập số tiền";
    }
    if (!is_numeric($soTien)) {
        $err[] = "Số tiền phải là số";
    } 

    if (empty($err)) {
        $sqlInsert = "INSERT INTO `phieu_ung_luong`(`MaPhieu`, `MaNV`, `NgayUng`, `LyDo`, `SoTien`, `Duyet`) VALUES ('$maPhieu','$maNV','$ngayUng','$lyDo',$soTien,'$duyet')";
        $resultInsert = mysqli_query($conn, $sqlInsert);
    
        if ($resultInsert) {
            echo "<script type='text/javascript'>toastr.success('Thêm phiếu ứng lương thành công'); toastr.options.timeOut = 3000;</script>";
        } else {
            echo "<script type='text/javascript'>toastr.error('Thêm phiếu ứng lương không thành công'); toastr.options.timeOut = 3000;</script>";
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
                <h4 class="mb-0">THÊM PHIẾU ỨNG LƯƠNG</h4>
            </div>
            <div class="table-responsive">
            <form align='center' action="" method="post" enctype="multipart/form-data">
                <table class="table table-hover table-nowrap">
                    <tr>
                            <td><p>Mã Phiếu</p></td>
                        <td>
                            <input class="form-control py-2" type="text" size="20" name="maPhieu" value="<?php echo $maPhieu; ?> " /></td>
                    </td>
                        <td><p>Mã nhân viên</p></td>
                        <td>            
                        <select name="maNV" class="form-select search-option">
                               
                                <?php
                                if (mysqli_num_rows($resultmanv ) <> 0) {

                                    while ($rows = mysqli_fetch_array($resultmanv )) {
                                        echo "<option value='$rows[MaNV]'";
                                        if (isset($_POST['MaNV']) && $_POST['MaNV'] == $rows['MaNV']) echo "selected";
                                        echo ">$rows[MaNV]</option>";
                                    }
                                }
                                ?>
                            </select>
                    </td>
                    </tr>

                    <tr>
                        <td><p>Số tiền</p></td>
                    
                        <td>
                            <input class="td-control py-2" type="text" size="20" name="soTien" value="<?php echo $soTien; ?> " />VND
                        </td>
                        
                            <td >
                                <p>Duyệt</p> 
                            </td>
                            <td>
                             <select name="duyet" class="form-select search-option">
                                    <option value="0" <?php if (isset($_POST['duyet']) && $_POST['duyet'] == '0') echo " selected"; ?>>Chưa duyệt</option>
                                    <option value="1" <?php if (isset($_POST['duyet']) && $_POST['duyet'] == '1') echo " selected"; ?>>Đã duyệt</option>
                                </select>        
                        </td>
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
                            <a class="btn btn-outline-purple addDepartmen-btn mb-5 w-25"
                                        href="index.php?page=admin-salary-slip"> Quay Lại</a>
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>     
    </div>
</div>
<?php $this->end(); ?>