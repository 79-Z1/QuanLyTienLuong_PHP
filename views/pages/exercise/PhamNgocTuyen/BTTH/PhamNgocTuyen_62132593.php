<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>QUẢN LÝ NHÂN VIÊN</title>
    <style type="text/css">
        body {  
            background-color: #d24dff;
        }
        table{
            background: #ffd94d;
            border: 0 solid yellow;
        }
        thead{
            background: #fff14d;    

        }
        td {
            color: blue;

        }
        h3{
            font-family: verdana;
            text-align: center;
            /* text-anchor: middle; */
            color: #ff8100;
            font-size: medium;
        }
    </style>
</head>
<body>
<?php 
    if(isset($_POST['name'])) 
        $name=trim($_POST['name']); 
    else $name="";
    if(isset($_POST['date1'])) 
        $date1=trim($_POST['date1']); 
    else $date1="";
    if(isset($_POST['child'])) 
        $child=trim($_POST['child']); 
    else $child="";
    if(isset($_POST['date2'])) 
        $date2=trim($_POST['date2']); 
    else $date2="";
    if(isset($_POST['salary'])) 
        $salary=trim($_POST['salary']); 
    else $salary="";
    if(isset($_POST['ngayvang'])) 
        $ngayvang=trim($_POST['ngayvang']); 
    else $ngayvang="";
    if(isset($_POST['sanpham'])) 
        $sanpham=trim($_POST['sanpham']); 
    else $sanpham="";

    if(isset($_POST['tienluong'])) 
        $tienluong=trim($_POST['tienluong']); 
    else $tienluong="";
    if(isset($_POST['trocap'])) 
        $trocap=trim($_POST['trocap']); 
    else $trocap="";
    if(isset($_POST['tienthuong'])) 
        $tienthuong=trim($_POST['tienthuong']); 
    else $tienthuong="";
    if(isset($_POST['tienphat'])) 
        $tienphat=trim($_POST['tienphat']); 
    else $tienphat="";
    if(isset($_POST['thuclinh'])) 
        $thuclinh=trim($_POST['thuclinh']); 
    else $thuclinh="";
    class nhanVienPNT{
        var $hoTen;
        var $gioiTinh;
        var $ngayVaoLam;
        var $heSoLuong;
        var $soCon;
        const luongCB = 1350000;
        function __construct($hoTen,$gioiTinh,$ngayVaoLam,$heSoLuong,$soCon){
            $this->hoTen=$hoTen;
            $this->gioiTinh=$gioiTinh;
            $this->ngayVaoLam=$ngayVaoLam;
            $this->heSoLuong=$heSoLuong;
            $this->soCon=$soCon;
        }
        function __tienThuong(){
            $tt = explode("/",$this->ngayVaoLam);
            return (date("Y") - $tt[2]) *1000000;
        }

    };
    class nvVanPhong extends nhanVienPNT{
        var $soNgayVang;
        const dinhMucVang = 4;
        const donGiaPhat = 200000;
        function __construct($hoTen,$gioiTinh,$ngayVaoLam,$heSoLuong,$soCon,$soNgayVang){
            parent::__construct($hoTen,$gioiTinh,$ngayVaoLam,$heSoLuong,$soCon);
            $this->soNgayVang=$soNgayVang;
        }
        function __tinhTienPhat(){
            if($this->soNgayVang > self::dinhMucVang){
               return ($this->soNgayVang * self::dinhMucVang) *self::donGiaPhat;
            }
            return 0;
        }
        function __tinhTroCap(){
            if($this->gioiTinh="Nu"){
                return    $this->soCon * 200000 * 1.5;
            }else{
                return  200000 * $this->soCon;
            }
        }
        function __tinhLuong(){
          return  (self::luongCB * $this->heSoLuong) - $this->__tinhTienPhat();
        }
    }
    class nvSanXuat extends nhanVienPNT{
        var $soSP;
        const donGiaSP = 100000;
        const dinhmucSP = 30;
        function __construct($hoTen,$gioiTinh,$ngayVaoLam,$heSoLuong,$soCon,$soSP){
            parent::__construct($hoTen,$gioiTinh,$ngayVaoLam,$heSoLuong,$soCon);
            $this->soSP=$soSP;
        }    
        function __tienThuongSX(){
            if($this->soSP > self::dinhmucSP){
                return ($this->soSP * self::dinhmucSP) + self::donGiaSP * 0.03;
            }
            return 0;
        }
        function _tienTroCap(){
            return $this->soCon * 120000;
        }
        function __tienluongSX(){
            return ($this->soSP * self::donGiaSP);
        }
    }
    if(isset($_POST['tinh'])){
        if($_POST['loaiNV']=='vanPhong')
        {
            $nv = new nvVanPhong($name,$_POST['radGT'],$date2,$salary,$child,$ngayvang);
            $tienluong = $nv->__tinhLuong();
            $tienthuong = $nv->__tienThuong() ;
            $trocap = $nv->__tinhTroCap();
            $tienphat = $nv-> __tinhTienPhat();
            $ngayvang = $nv->soNgayVang;
            $thuclinh = $tienluong + $tienthuong + $trocap - $tienphat;
        }
        else{
            $nv = new nvSanXuat($name,$_POST['radGT'],$date2,$salary,$child,$sanpham);
            $tienluong = $nv->__tienluongSX();
            $tienthuong = $nv->__tienThuongSX() ;
            $trocap = $nv->_tienTroCap();
            $thuclinh = $tienluong + $tienthuong + $trocap - $tienphat;
        }
        
    }
?>
<form align='center' action="" method="post">
<table>
    <thead>
        <th colspan="4" align="center"><h3>QUẢN LÝ NHÂN VIÊN</h3></th>
    </thead>

    <tr>
        <td>Nhập Họ Tên: </td>
        <td><input type="text" name="name" size="30" value="<?php  echo $name;?>"/> </td>
        <td >Số con: </td>
        <td><input type="text" name="child" value="<?php  echo $child;?> "/></td>
    </tr>
    <tr>
        <td>Nhập Ngày Sinh:</td>
            <td><input type="text" name="date1" value="<?php  echo $date1;?> "/></td>
        <td >Ngày vào làm: </td>
            <td><input type="text" name="date2" value="<?php  echo $date2;?> "/></td>
    </tr>
    <tr>
        <td>Giới tính:</td>
        <td><input type="radio" name="radGT" value="Nam"
            <?php if(isset($_POST['radGT'])&&$_POST['radGT']=='Nam') echo 'checked="checked"';?> checked/>Nam
        <input type="radio" name="radGT" value="Nu" 
            <?php if(isset($_POST['radGT'])&&$_POST['radGT']=='Nu') echo 'checked="checked"';?>/>Nữ<br></td>
        <td >Hệ số lương:</td> 
            <td><input type="text" name="salary" value="<?php  echo $salary;?> "/></td>
    </tr>
    <tr>
        <td>Loại nhân viên:</td>   
        <td><input type="radio" name="loaiNV" value="vanPhong"
        <?php if(isset($_POST['loaiNV'])&&$_POST['loaiNV']=='vanPhong') echo 'checked="checked"';?> checked/>Văn phòng<br></td>
        <td >
            <input type="radio" name="loaiNV" value="sanXuat" 
            <?php if(isset($_POST['loaiNV'])&&$_POST['loaiNV']=='sanXuat') echo 'checked="checked"';?>/> Sản xuất<br>
        </td>
    </tr>
    <tr>
        <td>
            
        </td>
        <td>Số ngày vắng:
            <input type="text" name="ngayvang" size="5" value="<?php  echo $ngayvang;?> "/></td>   
        <td>Số sản phẩm: </td>
            <td><input type="text" name="sanpham" value="<?php  echo $sanpham;?> "/></td>   
    </tr>        
        
           
    <tr>
     <td   colspan="4" align="center"><input type="submit" value="Tính lương" name="tinh" /></td>
    </tr>

    <tr>
            <td>Tiền lương: </td>
            <td><input type="text" name="tienluong"  value="<?php  echo $tienluong;?>" disabled/> </td>
            <td>Trợ cấp:<input type="text" name="trocap"  value="<?php  echo $trocap;?>"disabled/> </td>
    </tr>
    <tr>
            <td>Tiền thưởng: </td>
            <td><input type="text" name="tienthuong" value="<?php  echo $tienthuong;?>"disabled/> </td>
            <td>Tiền phạt:<input type="text" name="tienphat"  value="<?php  echo $tienphat;?>"disabled/> </td>
    </tr>
    <tr>
        <td>

        </td>
        <td colspan="2" align="center">Thực lĩnh:
            <input type="text" name="thuclinh"  value="<?php  echo $thuclinh;?>"disabled/></td>
    </tr>

</table>
</form>


</body>
</html>
<?php $this->end(); ?>
