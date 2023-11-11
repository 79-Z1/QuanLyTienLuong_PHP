<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Nhập thông tin</title>
    <style type="text/css">

    table {
        background: #ffd94d;
        border: 0 solid yellow;
    }

    thead {
        background: #fff14d;
    }
    td {
        color: blue;
    }
    h3 {
        font-family: verdana;
        text-align: center;
        color: #ff8100;
        font-size: medium;
    }
    </style>
</head>
<body>
    <?php
    class NhanVien{
        protected $hoten, $gioitinh, $ngayvaolam, $hesoluong, $socon;

        function sethoten($hoTen){
            $this->hoten = $hoTen;
        }
        function setgioitinh($gioiTinh){
            $this->gioitinh = $gioiTinh;
        }
        function setsocon($soCon){
            $this->socon = $soCon;
        }
        function setngayvaolam($ngayVaoLam){
            $this->ngayvaolam = $ngayVaoLam;
        }
        function sethesoluong($heSoLuong){
            $this->hesoluong = $heSoLuong;
        }
        function gethoten(){
            return $this->hoten;
        }
        function getgioitinh(){
            return $this->gioitinh;
        }
        function getngayvaolam(){
            return $this->ngayvaolam;
        }
        function gethesoluong(){
            return $this->hesoluong;
        }
        function getsocon(){
            return $this->socon;
        }
        const luongcoban = 1350000;
        function tinhtienluong(){

        }
        function tinhtrocap(){

        }
        function tinhtienthuong(){
            $str = explode('-',$this->ngayvaolam);
            $sonamlamviec = date('Y') - $str[2];
            return $sonamlamviec * 1000000;
        }
    }
    class NhanVienVP extends NhanVien{
        protected $songayvang;
        const dinhmucvang = 4;
        const dongiaphat = 200000;

        function setsongayvang($soNgayVang){
            $this->songayvang = $soNgayVang;
        }
        function getsongayvang(){
            return $this->songayvang;
        }

        function tinhtienphat(){
            if($this->songayvang > self::dinhmucvang){

                return ($this->songayvang - self::dinhmucvang) * self::dongiaphat;
            }
            return 0;
        }
        function tinhtrocap(){
            if($this->gioitinh == 'Nu'){
                return 200000 * $this->socon * 1.5;
            }
            else{
                return 200000 * $this->socon;
            }
        }
        function tinhtienluong(){
            return self::luongcoban * $this->hesoluong;
        }
    }
    class NhanVienSX extends NhanVien{
        protected $sosp;
        const dinhmucsp = 50;
        const dongiasp = 150000;
        function setsosp($soSP){
            $this->sosp = $soSP;
        }
        function getsosp(){
            return $this->sosp;
        }
        function tinhtienthuong(){
            if($this->sosp > self::dinhmucsp){
                return ($this->sosp - self::dinhmucsp) * self::dongiasp * 0.03;
            }
            return 0;
        }
        function tinhtrocap(){
            return $this->socon * 120000;
        }
        function tinhtienluong(){
            return ($this->sosp * self::dongiasp) + $this->tinhtienthuong();
        }
    }
    if(isset($_POST['xuli'])){
        if(!empty(trim($_POST['hoten'])) && !empty(trim($_POST['socon'])) && !empty(trim($_POST['ngaysinh']))&& !empty(trim($_POST['ngayvaolam'])) && !empty(trim($_POST['hesoluong']))){
            if($_POST['radLNV'] == 'VanPhong'){
                $nhanvien = new NhanVienVP();
                $nhanvien->sethoten($_POST['hoten']);
                $hoten = $nhanvien->gethoten();
                $nhanvien->setgioitinh($_POST['radGT']);
                $nhanvien->setsocon(trim($_POST['socon']));
                $socon = $nhanvien->getsocon();
                $ngaysinh = $_POST['ngaysinh'];
                $nhanvien->sethesoluong(trim($_POST['hesoluong']));
                $hesoluong = $nhanvien->gethesoluong();
                $nhanvien->setngayvaolam($_POST['ngayvaolam']);
                $ngayvaolam = $nhanvien->getngayvaolam();
                if(is_numeric($_POST['socon']) && is_numeric($_POST['hesoluong'])){
                    if(!empty(trim($_POST['songayvang']))){
                        $nhanvien->setsongayvang($_POST['songayvang']);
                        $songayvang = $nhanvien->getsongayvang();
                        $tienluong = number_format($nhanvien->tinhtienluong());
                        $trocap = number_format($nhanvien->tinhtrocap());
                        $tienthuong = number_format($nhanvien -> tinhtienthuong());
                        $tienphat = number_format($nhanvien -> tinhtienphat());
                        $thuclinh = number_format($tienluong + $trocap + $tienthuong - $tienphat);
                        
                    }
                    else echo "Vui lòng nhập vào số ngày vắng";
                }
                else echo "vui lòng nhập số con và hệ số lương là số";
            }
            else{
                $nhanvien = new NhanVienSX();
                if(is_numeric($_POST['socon']) && is_numeric($_POST['hesoluong'])){
                    if($_POST['hesoluong'] > 0){
                        $nhanvien->sethoten($_POST['hoten']);
                        $hoten = $nhanvien->gethoten();
                        $nhanvien->setgioitinh($_POST['radGT']);
                        $nhanvien->setsocon(trim($_POST['socon']));
                        $socon = $nhanvien->getsocon();
                        $ngaysinh = $_POST['ngaysinh'];
                        $nhanvien->sethesoluong(trim($_POST['hesoluong']));
                        $hesoluong = $nhanvien->gethesoluong();
                        $nhanvien->setngayvaolam($_POST['ngayvaolam']);
                        $ngayvaolam = $nhanvien->getngayvaolam();
                    }
                    else echo "Nhập hệ số lương lớn hơn 0";
                    if(!empty(trim($_POST['sosp']))){
                        $nhanvien->setsosp($_POST['sosp']);
                        $sosp = $nhanvien->getsosp();
                        $tienluong = number_format($nhanvien->tinhtienluong());
                        $trocap = number_format($nhanvien->tinhtrocap());
                        $tienthuong = number_format($nhanvien -> tinhtienthuong());
                        $thuclinh = $tienluong + $trocap + $tienthuong - $tienphat;
                    }
                    else echo "Vui lòng nhập vào số sản phẩm";
                }
                else echo "vui lòng nhập số con và hệ số lương là số";
            }
        }
        else echo "Vui lòng nhập đầy đủ thông tin";
    }
    ?>
    <form align='center' action="" method="post">
        <table>
            <thead>
                <th colspan="4" align="center">
                    <h3>Quản lý nhân viên</h3>
                </th>
            </thead>
            <tr>
                <td>Họ tên:</td>
                <td><input type="text" name="hoten" value="<?php  echo $hoten;?> " size="40"/></td>
                <td>Số con:</td>
                <td><input type="text" name="socon" value="<?php  echo $socon;?> " /></td>
            </tr>
            <tr>
                <td>Ngày sinh:</td>
                <td><input type="text" name="ngaysinh" value="<?php  echo $ngaysinh;?> " size="30"/></td>
                <td>Ngày vào làm:</td>
                <td><input type="text" name="ngayvaolam" value="<?php  echo $ngayvaolam;?> " size="30"/></td>
            </tr>
            <tr>
                <td>Giới tính:</td>
                <td style= "display: flex">
                <input type="radio" name="radGT" value="Nam"<?php if(isset($_POST['radGT'])&&$_POST['radGT']=='Nam') echo 'checked="checked"';?> checked/>Nam<br>
	            <input type="radio" name="radGT" value="Nu" <?php if(isset($_POST['radGT'])&&$_POST['radGT']=='Nu') echo 'checked="checked"';?>/>Nữ<br>
                </td>
                <td>Hệ số lương:</td>
                <td><input type="text" name="hesoluong" value="<?php  echo $hesoluong;?> " /></td>
            </tr>
            <tr>
                <td>Loại nhân viên:</td>
                <td style= "display: flex">
                <input type="radio" name="radLNV" value="VanPhong"<?php if(isset($_POST['radLNV'])&&$_POST['radLNV']=='VanPhong') echo 'checked="checked"';?> checked/>Văn phòng<br>
                </td>
                <td>
                <input type="radio" name="radLNV" value="SanXuat" <?php if(isset($_POST['radLNV'])&&$_POST['radLNV']=='SanXuat') echo 'checked="checked"';?>/>Sản xuất<br>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>Số ngày vắng: <input type="text" name="songayvang" value="<?php  echo $songayvang;?> " /></td>
                <td colspan="2">Số sản phẩm:<input type="text" name="sosp" value="<?php  echo $sosp;?> " /></td>
            </tr>
            <tr>
                <td colspan="4" align="center">
                    <input type="submit" class="btn btn-success" value="Tính" name="xuli" />
                </td>
            </tr>
            <tr>
                <td>Tiền lương:</td>
                <td><input type="text" name="tienluong" value="<?php  echo $tienluong . "VNĐ";?> " size="40" disabled="disabled"/></td>
                <td>Trợ cấp:</td>
                <td><input type="text" name="trocap" value="<?php  echo $trocap . "VNĐ";?> " disabled="disabled"/></td>
            </tr>
            <tr>
                <td>Tiền thưởng:</td>
                <td><input type="text" name="tienthuong" value="<?php  echo $tienthuong . "VNĐ";?> " size="40" disabled="disabled"/></td>
                <td>Tiền phạt:</td>
                <td><input type="text" name="tienphat" value="<?php  echo $tienphat . "VNĐ";?> " disabled="disabled"/></td>
            </tr>
            <tr>
                <td colspan ="4" align="center">Thực lĩnh: <input type="text" name="thuclinh" value="<?php  echo $thuclinh . "VNĐ";?> " disabled="disabled"/></td>
            </tr>
        </table>
    </form>
    <form action="" method="get">
<input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>
</body>
<?php $this->end(); ?>