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
    if(isset($_POST['maso'])) 
        $maso=trim($_POST['maso']); 
    else $maso="";
    if(isset($_POST['name'])) 
        $name=trim($_POST['name']); 
    else $name="";
    if(isset($_POST['date1'])) 
        $date1=trim($_POST['date1']); 
    else $date1="";
    if(isset($_POST['child'])) 
        $child=trim($_POST['child']); 
    else $child="";
    if(isset($_POST['cong'])) 
        $date2=trim($_POST['cong']); 
    else $date2="";
    if(isset($_POST['bao'])) 
        $date2=trim($_POST['bao']); 

    abstract class nhanVienCC{
    
        protected  $MaSo,$hoTen,$gioiTinh,$ngaySinh,$soNgaybao,$ngayCongTrongThang,$bacLuong;
        function __construct($MaSo,$hoTen,$gioiTinh,$ngaySinh,$ngayCongTrongThang,$bacLuong){
            $this->MaSo=$MaSo;
            $this->hoTen=$hoTen;
            $this->gioiTinh=$gioiTinh;
            $this->ngaySinh=$ngaySinh;
            $this->ngayCongTrongThang=$ngayCongTrongThang;
            $this->bacLuong=$bacLuong;
            } 
            public function getMaSo(){
                return $this->MaSo;
            }
            public function gethoTen(){
                return $this->hoTen;
            }
            public function getgioiTinh(){
                return $this->gioiTinh;
            }
            public function getngaySinh(){
                return $this->ngaySinh;
            }
            public function getngayCongTrongThang(){
                return $this->ngayCongTrongThang;
            }
            public function getbacLuong(){
                return $this->bacLuong;
            }
            
    }
        class NhaKhoaHoc extends nhanVienCC{
            const LuongCB = 1350000;
            const donGiaBaiBao = 200000;
            protected $soBaiBao;
            public function __construct($MaSo,$hoTen,$gioiTinh,$ngaySinh,$ngayCongTrongThang,$bacLuong, $soBaiBao){
                parent::__construct($MaSo,$hoTen,$gioiTinh,$ngaySinh,$ngayCongTrongThang,$bacLuong);
                $this->soBaiBao = $soBaiBao;
        }
        public function Luong(){
            if($this->soBaiBao == true){
                return($this->soBaiBao * self::donGiaBaiBao);
            }else{
                return ($this->ngayCongTrongThang * self:: LuongCB * $this->bacLuong);
            }
        }
    }
    class NhaQuanLi extends nhanVienCC{
        const LuongCBNgay = 45000;
        protected $chucVu,$heSoChucVu;
        public function __construct($MaSo, $hoTen, $gioiTinh, $ngaySinh, $ngayCongTrongThang, $chucVu, $heSoChucVu){
            parent::__construct($MaSo,$hoTen,$gioiTinh,$ngaySinh,$ngayCongTrongThang,$chucVu);
            $this->chucVu = $chucVu;           
            $this->heSoChucVu = $heSoChucVu;           
        }
        public function LuongQL(){
            if($this->gioiTinh == "Nu"){
                   return(($this->ngayCongTrongThang * self::LuongCBNgay * $this->bacLuong * $this->heSoChucVu)*0.05);
            }else{
                return($this->ngayCongTrongThang * self::LuongCBNgay * $this->bacLuong * $this->heSoChucVu);
            }    
        }
    }
?>
<form align='center' action="" method="post">
<table>
    <thead>
        <th colspan="4" align="center"><h3>QUẢN LÝ NHÂN VIÊN</h3></th>
    </thead>

    <tr>
        <td >Mã Số: </td>
        <td><input type="text" name="maso" value="<?php  echo $maso;?> "/></td>
        <td>Nhập Họ Tên: </td>
        <td><input type="text" name="name" size="30" value="<?php  echo $name;?>"/> </td>
    </tr>
    <tr>
        <td>Nhập Ngày Sinh:</td>
            <td><input type="text" name="date1" value="<?php  echo $date1;?> "/></td>
        <td >Số Ngày Công: </td>
            <td><input type="text" name="cong" value="<?php  echo $cong;?> "/></td>
        
    </tr>
    <tr>
    <td >Số Bài Báo: </td>
            <td><input type="text" name="bao" value="<?php  echo $bao;?> "/></td>

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
        <td>Chức vụ:</td>       
        
        <td>
        <select name="chucVu[]" multiple>
        <?php if(isset($_POST['chucVu'])&&$_POST['chucVu']=='caocap') ?>
            <option value="caocap"  selected>
            Cao cấp
            </option>
            <?php if(isset($_POST['chucVu'])&&$_POST['chucVu']=='khoahoc')?>
            <option value="khoahoc">
            Khoa Học
            </option>
            <?php if(isset($_POST['chucVu'])&&$_POST['chucVu']=='quanli') ?>
            <option value="quanli">
            Quản Lí
            </option>
        </td>

	</select>
    </tr>
           
    <tr>
     <td   colspan="4" align="center"><input type="submit" value="Lưu nhân viên" name="tinh" /></td>
    </tr>

   
   

</table>
<table>

<tr>
    <td>
    <br>

    <textarea name="comment" rows="3" cols="82,7"><?php if(isset($_POST['comment'])) echo $_POST['comment']; ?></textarea>

    <br>

    <input type="submit" value="Submit">
    </td>
</tr>
</table>
</form>


</body>
</html>
<?php $this->end(); ?>