<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/'.explode('/', $_SERVER['PHP_SELF'])[1]."/connect.php");

if(isset($_POST['SoNgayCong'])){
    $SoNgayCong = $_POST['SoNgayCong'];
}else $SoNgayCong = 0;

if(isset($_POST['HeSoLuong'])){
    $HeSoLuong = $_POST['HeSoLuong'];
}else $HeSoLuong = 0;

if(isset($_POST['LuongTC'])){
    $LuongTC = $_POST['LuongTC'];
}else $LuongTC = 0;

if(isset($_POST['TienTamUng'])){
    $TienTamUng = $_POST['TienTamUng'];
}else $TienTamUng = 0;

if(isset($_POST['Thue'])){
    $Thue = $_POST['Thue'];
}else $Thue = 0;

if(isset($_POST['TruBH'])){
    $TruBH = $_POST['TruBH'];
}else $TruBH = 0;

$err = array();

$sqlPL = "select *, HoNV, TenNV from phieu_luong, nhan_vien
        where phieu_luong.MaNV = '$_GET[MaNV]'
        and phieu_luong.MaNV = nhan_vien.MaNV ";
        
$resultPL = mysqli_query($conn, $sqlPL);

if (mysqli_num_rows($resultPL) > 0) {
    $PL = mysqli_fetch_array($resultPL);
}


$date = $PL['Nam'] .  $PL['Thang'] . date("d");

function TaoMaPhieuLuong($i,$date){
    if($i < 10){
        return "PL".  $date . "00" . $i;
    }
    elseif($i < 100){
        return "PL".  $date . "0" . $i;
    }
    else{
        return "PL".  $date . $i;
    }
}
for($i = 1; $i <= mysqli_num_rows($resultPL); $i++){
    $maPL = TaoMaPhieuLuong($i,$date);
}

if(isset($_POST['tinh'])){
    if(!is_numeric($SoNgayCong)){
        $err[] = "Vui lòng nhập số ngày công đúng định dạng số";
    }else if($SoNgayCong < 1 || $SoNgayCong > 31){
        $err[] = "Số ngày công phải lớn hơn 1 và bé hơn 31";
    }
    if(!is_numeric($HeSoLuong)){
        $err[] = "Vui lòng nhập hệ số lương đúng định dạng số";
    }
    if(!is_numeric($LuongTC)){
        $err[] = "Vui lòng nhập số lương tăng ca đúng định dạng số";
    }
    if(!is_numeric($TienTamUng)){
        $err[] = "Vui lòng nhập số tiền tạm ứng đúng định dạng số";
    }
    if(!is_numeric($Thue)){
        $err[] = "Vui lòng nhập số tiền thuế đúng định dạng số";
    }
    if(!is_numeric($TruBH)){
        $err[] = "Vui lòng nhập tiền bảo hiểm đúng định dạng số";
    }
}

?>
<div class="g-6 mb-6 w-100 search-container mt-5">
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card shadow border-0 mb-7">
            <div class="card-header">
                <h5 class="mb-0">PHIẾU LƯƠNG NHÂN VIÊN</h5>
            </div>
            <div class="table-responsive">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="table table-hover table-nowrap">
                <tr>
                    <td>Mã phiếu lương:</td>
                    <td><input type="text" size="20" name="maPL" value="<?php echo $maPL; ?> " disabled="disabled"/></td>
                    <td>Mã nhân viên:</td>
                    <td><input type="text" name="soCon" value="<?php echo $PL["MaNV"]; ?> " disabled="disabled" /></td>
                </tr>
                <tr>
                    <td >Họ và tên:</td>
                    <td ><input  type="text" size="20" name="hoTen" value="<?php echo $PL["HoTen"] . " " . $PL["TenNV"]; ?>" disabled="disabled"/></td>
                    <td>Phòng:</td>
                    <td ><input  type="text" name="Phong" value="<?php echo $PL["Phong"]; ?> " disabled="disabled"/></td>
                </tr>
                <tr>
                    <td>Tháng:</td>
                    <td><input  type="text" size="20" name="Thang" value="<?php echo $PL["Thang"]; ?>" disabled="disabled"/></td>
                    <td>Năm:</td>
                    <td><input  type="text" size="20" name="Nam" value="<?php echo $PL["Nam"]; ?>" disabled="disabled"/></td>
                </tr>
                <tr>
                    <td>Số ngày công:</td>
                    <td><input  type="text" size="20" name="SoNgayCong" value="<?php echo $SoNgayCong; ?>"/></td>
                    <td>Hệ số lương:</td>
                    <td><input  type="text" size="20" name="HeSoLuong" value="<?php echo $HeSoLuong; ?>"/></td>
                </tr>
                <tr>
                    <td>Lương tăng ca:</td>
                    <td><input  type="text" size="20" name="LuongTC" value="<?php echo $LuongTC; ?>"/></td>
                    <td>Tiền tạm ứng:</td>
                    <td><input  type="text" size="20" name="TienTamUng" value="<?php echo $TienTamUng; ?>"/></td>
                </tr>
                <tr>
                    <td>Thuế:</td>
                    <td><input  type="text" size="20" name="Thue" value="<?php echo $Thue; ?>"/></td>
                    <td>Trừ bảo hiểm:</td>
                    <td><input  type="text" size="20" name="TruBH" value="<?php echo $TruBH; ?>"/></td>
                </tr>
                <tr>
                    <td>Phạt:</td>
                    <td><input  type="text" size="20" name="Phat" value="<?php echo $PL["Phat"]; ?>" disabled="disabled"/></td>
                    <td>Thưởng:</td>
                    <td><input  type="text" size="20" name="Thuong" value="<?php echo $PL["Thuong"]; ?>" disabled="disabled"/></td>
                </tr>
                <tr>
                    <td>Trợ cấp:</td>
                    <td><input  type="text" size="20" name="TroCap" value="<?php echo $PL["TroCap"]; ?>" disabled="disabled"/></td>
                    <td>Thực lĩnh:</td>
                    <td><input  type="text" size="20" name="ThucLinh" value="<?php echo $PL["ThucLinh"]; ?>" disabled="disabled"/></td>
                </tr>
                <tr>
                    <td id="no_color" colspan="4" align="center">
                    <input type="submit" value="Tính lương" name="tinh" class="btn btn-outline-purple themnhanvien-btn mb-5 w-25"/>
                    </td>
                </tr>
                </table>
                </form>
            </div>
        </div>     
    </div>
</div>