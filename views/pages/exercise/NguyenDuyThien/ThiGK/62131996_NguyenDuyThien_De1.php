<?php


abstract class NhanVienCaoCap{
    protected $maso,$hoten,$ngaysinh,$gioitinh,$songaycong,$bacluong;

    function __construct($maSo,$hoTen,$ngaySinh,$gioiTinh,$soNgayCong,$bacLuong){
        $this->maso = $maSo;
        $this->hoten = $hoTen;
        $this->ngaysinh = $ngaySinh;
        $this->gioitinh = $gioiTinh;
        $this->songaycong = $soNgayCong;
        $this->bacluong = $bacLuong;
    }

    function setmaso($maSo){
        $this->maso = $maSo;
    }
    function sethoten($hoTen){
        $this->hoten = $hoTen;
    }
    function setngaysinh($ngaysinh){
        $this->ngaysinh = $ngaysinh;
    }
    function setgioitinh($gioiTinh){
        $this->gioitinh = $gioiTinh;
    }
    function setsongaycong($soNgayCong){
        $this->songaycong = $soNgayCong;
    }
    function setbacluong($bacLuong){
        $this->bacluong = $bacLuong;
    }
    function getmaso(){
        return $this->maso;
    }
    function gethoten(){
        return $this->hoten;
    }
    function getngaysinh(){
        return $this->ngaysinh;
    }
    function getgioitinh(){
        return $this->gioitinh;
    }
    function getsongaycong(){
        return $this->songaycong;
    }
    function getbacluong(){
        return $this->bacluong;
    }

    abstract function TinhLuong();
}
class NhaKhoaHoc extends NhanVienCaoCap{
    const luongcobanmotngay = 300000;
    protected $sobaibao;
    const dongiabaibao = 20000000;

    function __construct($maSo,$hoTen,$ngaySinh,$gioiTinh,$soNgayCong,$bacLuong,$soBaiBao){
        parent::__construct($maSo,$hoTen,$ngaySinh,$gioiTinh,$soNgayCong,$bacLuong);
        $this->sobaibao = $soBaiBao;
    }

    function setsobaibao($soBaiBao){
        $this->sobaibao = $soBaiBao;
    }
    function getsobaibao(){
        return $this->sobaibao;
    }

    function TinhLuong(){
        if($this->sobaibao > 0 ){
            return $this->sobaibao * self::dongiabaibao;
        }
        return $this->songaycong * self::luongcobanmotngay * $this->bacluong;
    }
}
class NhaQuanLy extends NhanVienCaoCap{
    const luongcobanmotngay = 500000;
    protected $chucvu, $hesochucvu;

    function setchucvu($chucVu){
        $this->chucvu = $chucVu;
    }
    function sethesochucvu($heSoChucVu){
        $this->hesochucvu = $heSoChucVu;
    }
    function getchucvu(){
        return $this->chucvu;
    }
    function gethesochucvu(){
        return $this->hesochucvu;
    }

    function __construct($maSo,$hoTen,$ngaySinh,$gioiTinh,$soNgayCong,$bacLuong,$chucVu,$heSoChucVu){
        parent::__construct($maSo,$hoTen,$ngaySinh,$gioiTinh,$soNgayCong,$bacLuong);
        $this->chucvu = $chucVu;
        $this->hesochucvu = $heSoChucVu;
    }

    function TinhLuong()
    {
        if($this->gioitinh == 'Nữ'){
            ($this->songaycong * self::luongcobanmotngay * $this->bacluong * $this->hesochucvu) + 0.05;
        }
        return $this->songaycong * self::luongcobanmotngay * $this->bacluong * $this->hesochucvu;
    }
}

if(isset($_POST['manv'])){
    $manv = $_POST['manv'];
}else $manv = "";
if(isset($_POST['hoten'])){
    $hoten = $_POST['hoten'];
}else $hoten = "";
if(isset($_POST['ngaysinh'])){
    $ngaysinh = $_POST['ngaysinh'];
}else $ngaysinh = "";
if(isset($_POST['radGT'])){
    $gioitinh = $_POST['radGT'];
}else $gioitinh = "";
if(isset($_POST['ngaycong'])){
    $ngaycong = $_POST['ngaycong'];
}else $ngaycong = 0;
if(isset($_POST['bacluong'])){
    $bacluong = $_POST['bacluong'];
}else $bacluong = 0;
if(isset($_POST['hesochucvu'])){
    $hesochucvu = $_POST['hesochucvu'];
}else $hesochucvu = 0;
if(isset($_POST['sobaibao'])){
    $sobaibao = $_POST['sobaibao'];
}else $sobaibao = 0;

if(isset($_POST['luu'])){
    if($ngaycong <= 20){
        if(isset($_POST['chucvu']) && $_POST['chucvu'] == "trống"){
            $file = "Nhakhoahoc.dat";
            $myfile = fopen($file, "a+") or die("Unable to open file!");
            $nhanvien = new NhaKhoaHoc($manv,$hoten,$ngaysinh,$gioitinh,$ngaycong,$bacluong,$sobaibao);
            fwrite($myfile, "Mã số nhân viên: " . $nhanvien->getmaso() . "\n");
            fwrite($myfile, "Họ tên nhân viên: " . $nhanvien->gethoten(). "\n");
            fwrite($myfile, "Ngày sinh: " .  $nhanvien->getngaysinh() . "\n");
            fwrite($myfile, "Giới tính: " .  $nhanvien->getgioitinh() . "\n");
            fwrite($myfile, "Số ngày công: " . $nhanvien->getsongaycong() . "\n");
            fwrite($myfile, "Bậc lương: " .  $nhanvien->getbacluong() . "\n");
            fwrite($myfile, "Số bài báo: " . $nhanvien->getsobaibao() . "\n");
            fwrite($myfile, "Lương: " .  $nhanvien->TinhLuong() . "\n");
            fclose($myfile);
        }
        else{
            $file = "Nhaquanly.dat";
            $myfile = fopen($file, "a+") or die("Unable to open file!");
            $nhanvien = new NhaQuanLy($manv,$hoten,$ngaysinh,$gioitinh,$ngaycong,$bacluong,$chucvu,$hesochucvu);
            fwrite($myfile, "Mã số nhân viên: " . $nhanvien->getmaso() . "\n");
            fwrite($myfile, "Họ tên nhân viên: " . $nhanvien->gethoten(). "\n");
            fwrite($myfile, "Ngày sinh: " .  $nhanvien->getngaysinh() . "\n");
            fwrite($myfile, "Giới tính: " .  $nhanvien->getgioitinh() . "\n");
            fwrite($myfile, "Số ngày công: " . $nhanvien->getsongaycong() . "\n");
            fwrite($myfile, "Bậc lương: " .  $nhanvien->getbacluong() . "\n");
            fwrite($myfile, "Số bài báo: " . $nhanvien->getchucvu() . "\n");
            fwrite($myfile, "Số bài báo: " . $nhanvien->gethesochucvu() . "\n");
            fwrite($myfile, "Lương: " .  $nhanvien->TinhLuong() . "\n");
            fclose($myfile);
        }
    }
    else echo "Số ngày công không được nhập quá 20 ngày";    
}
?>
<form action="" method="post">

<fieldset>
	<legend>Nhập thông tin</legend>
	<table border="0" cellpadding="0">
    <tr>
        <td>Mã Số:</td>
        <td><input type="text" name="manv" value="<?php  echo $manv;?> " size="15"/></td>
    </tr>
    <tr>
        <td>Họ và tên:</td>
        <td><input type="text" name="hoten" value="<?php  echo $hoten;?> " size="30"/></td>
    </tr>
    <tr>
        <td>Ngày sinh:</td>
        <td><input type="date" name="ngaysinh" value="<?php  echo $ngaysinh;?> " /></td>
    </tr>
    <tr>
        <td>Chức vụ:</td>
        <td>
        <select name="chucvu">
            <option value="trống">Trống</option>
            <option value="Giám Đốc" <?php if(isset($_POST['chucvu'])&& $_POST['chucvu']=='Giám Đốc') echo 'selected';?>>
            Giám đốc
            </option>
            <option value="Lao công" <?php if(isset($_POST['chucvu'])&& $_POST['chucvu']=='Lao công') echo 'selected';?>>
            Lao công
            </option>
            <option value="Bảo vệ" <?php if(isset($_POST['chucvu'])&& $_POST['chucvu']=='Bảo vệ') echo 'selected';?>>
            Bảo vệ
            </option>
        </select>
        </td>
    </tr>
    <tr>
        <td>Giới tính:</td>
        <td style= "display: flex">
        <input type="radio" name="radGT" value="Nam"<?php if(isset($_POST['radGT'])&&$_POST['radGT']=='Nam') echo 'checked="checked"';?> checked/>Nam<br>
        <input type="radio" name="radGT" value="Nữ" <?php if(isset($_POST['radGT'])&&$_POST['radGT']=='Nữ') echo 'checked="checked"';?>/>Nữ<br>
        </td>
    </tr>
    <tr>
        <td>Số ngày công:</td>
        <td><input type="text" name="ngaycong" value="<?php  echo $ngaycong;?> " size="10"/></td>
    </tr>
    <tr>
        <td>Bậc lương:</td>
        <td><input type="text" name="bacluong" value="<?php  echo $bacluong;?> " size="10"/></td>
    </tr>
    <tr>
        <td>Hệ số chức vu:</td>
        <td><input type="text" name="hesochucvu" value="<?php  echo $hesochucvu;?> " size="10"/></td>
    </tr>
    <tr>
        <td>Số bài báo:</td>
        <td><input type="text" name="sobaibao" value="<?php  echo $sobaibao;?> " size="10"/></td>
    </tr>
    <tr>
        <td colspan="2" align="center"><input type="submit" name="hienthi"  size="20" value="Hiển thị thông tin nhân viên"/></td>
        <td colspan="2" align="center"><input type="submit" name="luu"  size="20" value="Lưu nhân viên"/></td>
    </tr>
</table>
<?php
if(isset($_POST['hienthi'])){
    if(isset($_POST['chucvu']) && $_POST['chucvu'] == "trống"){
        $file = "Nhakhoahoc.dat";
        $myfile = fopen($file, "r") or die("Unable to open file!");
    }
    else{
        $file = "Nhaquanly.dat";
        $myfile = fopen($file, "r") or die("Unable to open file!");
        
    }
}
?>